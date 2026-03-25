<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportBookmakersJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-bookmakers')]
class ImportBookmakersCommand extends Command
{
    public function handle(): void
    {
        ImportBookmakersJob::dispatch();
    }
}
