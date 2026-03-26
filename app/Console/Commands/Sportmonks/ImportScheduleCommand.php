<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportScheduleJob;
use App\Models\Season;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-schedule {seasonId}')]
class ImportScheduleCommand extends Command
{
    public function handle(): void
    {
        $seasonId = $this->argument('seasonId');

        if ($seasonId === 'all') {
            $seasons = Season::pluck('id')->all();

            foreach ($seasons as $seasonId) {
                ImportScheduleJob::dispatch($seasonId);
            }
        } elseif (is_numeric($seasonId)) {
            ImportScheduleJob::dispatch($seasonId);
        }
    }
}
