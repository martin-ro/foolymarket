<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\ImportContinentsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-continents')]
class ImportContinentsCommand extends Command
{
    public function handle(): void
    {
        ImportContinentsJob::dispatch();
    }
}
