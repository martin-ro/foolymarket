<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportScheduleJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-schedule {seasonId}')]
class ImportScheduleCommand extends Command
{
    public function handle(): void
    {
        $seasonId = $this->argument('seasonId');

        ImportScheduleJob::dispatch($seasonId);
    }
}
