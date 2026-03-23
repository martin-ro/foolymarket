#!/usr/bin/env bash
set -euo pipefail

if [ -z "${SUPERSET_WORKSPACE_NAME:-}" ]; then
  echo "SUPERSET_WORKSPACE_NAME is required."
  exit 1
fi

require_command() {
  local command_name="$1"
  if ! command -v "$command_name" >/dev/null 2>&1; then
    echo "Required command not found: $command_name"
    exit 1
  fi
}

require_executable() {
  local executable_path="$1"
  if [ ! -x "$executable_path" ]; then
    echo "Required executable not found: $executable_path"
    exit 1
  fi
}

env_get_from_file() {
  local file_path="$1"
  local key="$2"
  local value
  value="$(grep -E "^${key}=" "$file_path" | tail -n 1 | cut -d '=' -f2- || true)"
  value="${value%\"}"
  value="${value#\"}"
  value="${value%\'}"
  value="${value#\'}"
  printf '%s' "$value"
}

drop_database_if_exists() {
  local database_name="$1"

  if [ -z "$database_name" ]; then
    return 0
  fi

  local database_name_literal
  local database_name_identifier

  database_name_literal="$(printf "%s" "$database_name" | sed "s/'/''/g")"
  database_name_identifier="$(printf '%s' "$database_name" | sed 's/"/""/g')"

  echo "Dropping workspace database: $database_name"

  PGPASSWORD="$DB_PASSWORD" "$PSQL_BIN" -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USERNAME" -d postgres -v ON_ERROR_STOP=1 <<SQL
SELECT pg_terminate_backend(pid)
FROM pg_stat_activity
WHERE datname = '${database_name_literal}'
  AND pid <> pg_backend_pid();
DROP DATABASE IF EXISTS "${database_name_identifier}";
SQL
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

require_command herd
require_command psql

PSQL_LINK_PATH="$(command -v psql)"
PSQL_TARGET_PATH="$PSQL_LINK_PATH"

if [ -L "$PSQL_LINK_PATH" ]; then
  LINK_TARGET="$(readlink "$PSQL_LINK_PATH" || true)"
  if [ -n "$LINK_TARGET" ]; then
    if [[ "$LINK_TARGET" = /* ]]; then
      PSQL_TARGET_PATH="$LINK_TARGET"
    else
      PSQL_TARGET_PATH="$(cd "$(dirname "$PSQL_LINK_PATH")" && cd "$(dirname "$LINK_TARGET")" && pwd)/$(basename "$LINK_TARGET")"
    fi
  fi
fi

PSQL_BIN="${SUPERSET_PSQL_BIN:-$PSQL_TARGET_PATH}"
require_executable "$PSQL_BIN"

DOMAIN_SLUG="$(slugify_domain "$SUPERSET_WORKSPACE_NAME")"
DOMAIN_NAME="foolymarket-${DOMAIN_SLUG}"
DOMAIN_NAME="${DOMAIN_NAME:0:63}"
DOMAIN_NAME="${DOMAIN_NAME%-}"

DB_SLUG="$(slugify_db "$SUPERSET_WORKSPACE_NAME")"
TARGET_DB_NAME="foolymarket_ws_${DB_SLUG}"
TARGET_DB_NAME="${TARGET_DB_NAME:0:63}"
TARGET_DB_NAME="${TARGET_DB_NAME%_}"

ENV_FILE=".env"
if [ ! -f "$ENV_FILE" ] && [ -n "${SUPERSET_ROOT_PATH:-}" ] && [ -f "$SUPERSET_ROOT_PATH/.env" ]; then
  ENV_FILE="$SUPERSET_ROOT_PATH/.env"
fi

if [ ! -f "$ENV_FILE" ]; then
  echo "No .env file found for teardown DB credentials."
  exit 1
fi

DB_HOST="$(env_get_from_file "$ENV_FILE" DB_HOST)"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="$(env_get_from_file "$ENV_FILE" DB_PORT)"
DB_PORT="${DB_PORT:-5432}"
DB_USERNAME="$(env_get_from_file "$ENV_FILE" DB_USERNAME)"
DB_PASSWORD="$(env_get_from_file "$ENV_FILE" DB_PASSWORD)"
DB_DATABASE_FROM_ENV="$(env_get_from_file "$ENV_FILE" DB_DATABASE)"

if [ -z "$DB_USERNAME" ]; then
  echo "DB_USERNAME must be set in $ENV_FILE"
  exit 1
fi

herd unlink "$DOMAIN_NAME" || true

if [[ "$DB_DATABASE_FROM_ENV" == foolymarket_ws_* ]]; then
  drop_database_if_exists "$DB_DATABASE_FROM_ENV"
else
  echo "Skipping DB_DATABASE from $ENV_FILE (not workspace DB): ${DB_DATABASE_FROM_ENV:-<empty>}"
fi

if [ "$TARGET_DB_NAME" != "$DB_DATABASE_FROM_ENV" ]; then
  drop_database_if_exists "$TARGET_DB_NAME"
fi

echo "Superset workspace teardown complete."
