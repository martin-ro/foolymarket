<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\ImportCountriesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-countries')]
class ImportCountriesCommand extends Command
{
    public function handle(): void
    {
        ImportCountriesJob::dispatch();
    }
}
