<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportRoundsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-rounds')]
class ImportRoundsCommand extends Command
{
    public function handle(): void
    {
        ImportRoundsJob::dispatch();
    }
}
