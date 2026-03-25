<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportTypesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-types')]
class ImportTypesCommand extends Command
{
    public function handle(): void
    {
        ImportTypesJob::dispatch();
    }
}
