<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportTeamsJob;
use App\Models\Season;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-teams')]
class ImportTeamsCommand extends Command
{
    public function handle(): void
    {
        Season::query()
            ->whereHas('league')
            ->pluck('id')
            ->each(fn ($id) => ImportTeamsJob::dispatch($id));
    }
}
