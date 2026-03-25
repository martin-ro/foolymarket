<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(storage_path('seed-data/players.json')),
            associative: true,
        );

        foreach (array_chunk($data, 1000) as $chunk) {
            Player::query()->upsert($chunk, ['id']);
        }
    }
}
