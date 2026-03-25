<?php

namespace Database\Seeders;

use App\Models\Referee;
use Illuminate\Database\Seeder;

class RefereeSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/referees.json')),
            associative: true,
        );

        foreach (array_chunk($data, 1000) as $chunk) {
            Referee::query()->upsert($chunk, ['id']);
        }
    }
}
