<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportMarketsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-markets')]
class ImportMarketsCommand extends Command
{
    public function handle(): void
    {
        ImportMarketsJob::dispatch();
    }
}
