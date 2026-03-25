<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportSeasonsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-seasons')]
class ImportSeasonsCommand extends Command
{
    public function handle(): void
    {
        ImportSeasonsJob::dispatch();
    }
}
