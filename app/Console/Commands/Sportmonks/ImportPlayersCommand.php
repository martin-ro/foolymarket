<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportPlayersJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-players')]
class ImportPlayersCommand extends Command
{
    public function handle(): void
    {
        ImportPlayersJob::dispatch();
    }
}
