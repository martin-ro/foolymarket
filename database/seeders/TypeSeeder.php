<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/types.json')),
            associative: true,
        );

        Type::query()->upsert($data, ['id']);
    }
}
