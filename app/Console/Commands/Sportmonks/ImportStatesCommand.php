<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportStatesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-states')]
class ImportStatesCommand extends Command
{
    public function handle(): void
    {
        ImportStatesJob::dispatch();
    }
}
