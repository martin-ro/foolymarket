<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/scores.json')),
            associative: true,
        );

        foreach (array_chunk($data, 1000) as $chunk) {
            Score::query()->upsert($chunk, ['id']);
        }
    }
}
