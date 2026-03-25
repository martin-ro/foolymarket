<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportRivalsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-rivals')]
class ImportRivalsCommand extends Command
{
    public function handle(): void
    {
        ImportRivalsJob::dispatch();
    }
}
