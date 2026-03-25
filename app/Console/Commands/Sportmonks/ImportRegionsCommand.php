<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportRegionsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-regions')]
class ImportRegionsCommand extends Command
{
    public function handle(): void
    {
        ImportRegionsJob::dispatch();
    }
}
