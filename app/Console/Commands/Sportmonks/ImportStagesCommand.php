<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportStagesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-stages')]
class ImportStagesCommand extends Command
{
    public function handle(): void
    {
        ImportStagesJob::dispatch();
    }
}
