<?php

namespace App\Console\Commands\Sportmonks;

use App\Jobs\Sportmonks\ImportTeamSquadsJob;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sportmonks:import-team-squads')]
class ImportTeamSquadsCommand extends Command
{
    public function handle(): void
    {
        ImportTeamSquadsJob::dispatch();
    }
}
