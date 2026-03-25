<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportLeaguesJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-leagues')]
class ImportLeaguesCommand extends Command
{
    public function handle(): void
    {
        ImportLeaguesJob::dispatch();
    }
}
