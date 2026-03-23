<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    public function run(): void
    {
        Continent::factory()->create([
            'id' => 1,
            'name' => 'Europe',
            'code' => 'EU',
        ]);
    }
}
