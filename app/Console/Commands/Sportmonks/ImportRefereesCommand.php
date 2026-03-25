<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportRefereesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-referees')]
class ImportRefereesCommand extends Command
{
    public function handle(): void
    {
        ImportRefereesJob::dispatch();
    }
}
