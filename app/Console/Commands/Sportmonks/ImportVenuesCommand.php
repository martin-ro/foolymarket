<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportVenuesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-venues')]
class ImportVenuesCommand extends Command
{
    public function handle(): void
    {
        ImportVenuesJob::dispatch();
    }
}
