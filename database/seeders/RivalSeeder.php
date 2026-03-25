<?php

namespace Database\Seeders;

use App\Models\Rival;
use Illuminate\Database\Seeder;

class RivalSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/rivals.json')),
            associative: true,
        );

        Rival::query()->upsert($data, ['id']);
    }
}
