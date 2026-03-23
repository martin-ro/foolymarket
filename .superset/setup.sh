#!/usr/bin/env bash
set -euo pipefail

if [ -z "${SUPERSET_ROOT_PATH:-}" ]; then
  echo "SUPERSET_ROOT_PATH is required."
  exit 1
fi

if [ -z "${SUPERSET_WORKSPACE_NAME:-}" ]; then
  echo "SUPERSET_WORKSPACE_NAME is required."
  exit 1
fi

if [ ! -f "$SUPERSET_ROOT_PATH/.env" ]; then
  echo "Root .env file not found at $SUPERSET_ROOT_PATH/.env"
  exit 1
fi

require_command() {
  local command_name="$1"
  if ! command -v "$command_name" >/dev/null 2>&1; then
    echo "Required command not found: $command_name"
    exit 1
  fi
}

env_get() {
  local key="$1"
  local value
  value="$(grep -E "^${key}=" .env | tail -n 1 | cut -d '=' -f2- || true)"
  value="${value%\"}"
  value="${value#\"}"
  value="${value%\'}"
  value="${value#\'}"
  printf '%s' "$value"
}

env_set() {
  local key="$1"
  local value="$2"
  local escaped_value

  escaped_value="$(printf '%s' "$value" | sed 's/[\\&]/\\&/g')"

  if grep -q "^${key}=" .env; then
    sed -i '' "s|^${key}=.*|${key}=${escaped_value}|" .env
  else
    printf '%s=%s\n' "$key" "$value" >>.env
  fi
}

slugify_domain() {
  local input="$1"
  local output
  output="$(printf '%s' "$input" | tr '[:upper:]' '[:lower:]' | sed -E 's/[^a-z0-9-]+/-/g; s/^-+//; s/-+$//; s/-{2,}/-/g')"
  if [ -z "$output" ]; then
    output="workspace"
  fi
  printf '%s' "$output"
}

slugify_db() {
  local input="$1"
  local output
  output="$(printf '%s' "$input" | tr '[:upper:]' '[:lower:]' | sed -E 's/[^a-z0-9_]+/_/g; s/^_+//; s/_+$//; s/_{2,}/_/g')"
  if [ -z "$output" ]; then
    output="workspace"
  fi
  printf '%s' "$output"
}

patch_mcp_site_path() {
  local mcp_file=".mcp.json"

  if [ ! -f "$mcp_file" ]; then
    echo "No .mcp.json found in workspace; skipping MCP site path patch."
    return 0
  fi

  php <<'PHP'
<?php
$mcpFile = '.mcp.json';
$raw = file_get_contents($mcpFile);
if ($raw === false) {
    fwrite(STDERR, "Unable to read .mcp.json\n");
    exit(1);
}

$config = json_decode($raw, true);
if (!is_array($config)) {
    fwrite(STDERR, ".mcp.json is not valid JSON\n");
    exit(1);
}

if (!isset($config['mcpServers']) || !is_array($config['mcpServers'])) {
    $config['mcpServers'] = [];
}

if (!isset($config['mcpServers']['herd']) || !is_array($config['mcpServers']['herd'])) {
    $config['mcpServers']['herd'] = [
        'command' => 'php',
        'args' => ['/Applications/Herd.app/Contents/Resources/herd-mcp.phar'],
    ];
}

if (!isset($config['mcpServers']['herd']['env']) || !is_array($config['mcpServers']['herd']['env'])) {
    $config['mcpServers']['herd']['env'] = [];
}

$config['mcpServers']['herd']['env']['SITE_PATH'] = getcwd();

$encoded = json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
if (!is_string($encoded)) {
    fwrite(STDERR, "Unable to encode .mcp.json content\n");
    exit(1);
}

file_put_contents($mcpFile, $encoded . PHP_EOL);
PHP
}

require_command herd
require_command php
require_command composer
require_command npm
require_command pg_dump
require_command pg_restore
require_command psql

DOMAIN_SLUG="$(slugify_domain "$SUPERSET_WORKSPACE_NAME")"
DOMAIN_NAME="foolymarket-${DOMAIN_SLUG}"
DOMAIN_NAME="${DOMAIN_NAME:0:63}"
DOMAIN_NAME="${DOMAIN_NAME%-}"

DB_SLUG="$(slugify_db "$SUPERSET_WORKSPACE_NAME")"
TARGET_DB_NAME="foolymarket_ws_${DB_SLUG}"
TARGET_DB_NAME="${TARGET_DB_NAME:0:63}"
TARGET_DB_NAME="${TARGET_DB_NAME%_}"

SOURCE_DB_NAME="foolymarket_local"

echo "Using workspace domain: $DOMAIN_NAME.test"
echo "Using workspace database: $TARGET_DB_NAME"

herd link "$DOMAIN_NAME" --secure

mkdir -p .idea
cat >.idea/watcherTasks.xml <<'XMLEOF'
<?xml version="1.0" encoding="UTF-8"?>
<project version="4">
  <component name="ProjectTasksOptions">
    <TaskOptions isEnabled="true">
      <option name="arguments" value="--preset laravel --dirty" />
      <option name="checkSyntaxErrors" value="true" />
      <option name="description" />
      <option name="exitCodeBehavior" value="ERROR" />
      <option name="fileExtension" value="php" />
      <option name="immediateSync" value="false" />
      <option name="name" value="Pint" />
      <option name="output" value="$FilePath$" />
      <option name="outputFilters">
        <array />
      </option>
      <option name="outputFromStdout" value="false" />
      <option name="program" value="$PROJECT_DIR$/vendor/laravel/pint/builds/pint" />
      <option name="runOnExternalChanges" value="false" />
      <option name="scopeName" value="Project Files" />
      <option name="trackOnlyRoot" value="false" />
      <option name="workingDir" value="$ProjectFileDir$" />
      <envs />
    </TaskOptions>
  </component>
</project>
XMLEOF

cp "$SUPERSET_ROOT_PATH/.env" .env

DB_HOST="$(env_get DB_HOST)"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="$(env_get DB_PORT)"
DB_PORT="${DB_PORT:-5432}"
DB_USERNAME="$(env_get DB_USERNAME)"
DB_PASSWORD="$(env_get DB_PASSWORD)"

if [ -z "$DB_USERNAME" ]; then
  echo "DB_USERNAME must be set in .env"
  exit 1
fi

SOURCE_DB_EXISTS="$(PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d postgres -Atqc "SELECT 1 FROM pg_database WHERE datname = '${SOURCE_DB_NAME}'")"
if [ "$SOURCE_DB_EXISTS" != "1" ]; then
  echo "Source database does not exist: $SOURCE_DB_NAME"
  exit 1
fi

DUMP_FILE="$(mktemp -t foolymarket-superset-db.XXXXXX.dump)"
trap 'rm -f "$DUMP_FILE"' EXIT

PGPASSWORD="$DB_PASSWORD" pg_dump \
  -h "$DB_HOST" \
  -p "$DB_PORT" \
  -U "$DB_USERNAME" \
  -d "$SOURCE_DB_NAME" \
  -Fc \
  --no-owner \
  --no-privileges \
  -f "$DUMP_FILE"

PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d postgres -v ON_ERROR_STOP=1 <<SQL
SELECT pg_terminate_backend(pid)
FROM pg_stat_activity
WHERE datname = '${TARGET_DB_NAME}'
  AND pid <> pg_backend_pid();
DROP DATABASE IF EXISTS "${TARGET_DB_NAME}";
CREATE DATABASE "${TARGET_DB_NAME}";
SQL

PGPASSWORD="$DB_PASSWORD" pg_restore \
  -h "$DB_HOST" \
  -p "$DB_PORT" \
  -U "$DB_USERNAME" \
  -d "$TARGET_DB_NAME" \
  --clean \
  --if-exists \
  --no-owner \
  --no-privileges \
  "$DUMP_FILE"

env_set DB_DATABASE "$TARGET_DB_NAME"
env_set APP_URL "https://${DOMAIN_NAME}.test"

patch_mcp_site_path

composer install
npm ci
npm run build

echo "Superset workspace setup complete."
