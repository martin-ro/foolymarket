<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportCitiesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-cities')]
class ImportCitiesCommand extends Command
{
    public function handle(): void
    {
        ImportCitiesJob::dispatch();
    }
}
