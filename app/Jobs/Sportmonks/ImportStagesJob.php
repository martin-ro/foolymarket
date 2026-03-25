<?php

namespace App\Jobs\Sportmonks;

use App\Models\League;
use App\Models\Season;
use App\Models\Stage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Attributes\Backoff;
use Illuminate\Queue\Attributes\Tries;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PyaeSoneAung\SportmonksFootballApi\Facades\SportmonksFootballApi;

#[Tries(3)]
#[Backoff([10, 30, 60])]
class ImportStagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::stage()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        $stages = $response->collect('data');

        $existingLeagueIds = League::whereIn('id', $stages->pluck('league_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        $existingSeasonIds = Season::whereIn('id', $stages->pluck('season_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        foreach ($stages as $stage) {
            if (! isset($existingLeagueIds[$stage['league_id']]) || ! isset($existingSeasonIds[$stage['season_id']])) {
                continue;
            }

            Stage::updateOrCreate(
                ['id' => $stage['id']],
                $stage,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
