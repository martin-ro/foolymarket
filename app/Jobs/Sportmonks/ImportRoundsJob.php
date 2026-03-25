<?php

namespace App\Jobs\Sportmonks;

use App\Models\League;
use App\Models\Round;
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
class ImportRoundsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::round()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        $rounds = $response->collect('data');

        $existingLeagueIds = League::whereIn('id', $rounds->pluck('league_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        $existingSeasonIds = Season::whereIn('id', $rounds->pluck('season_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        $existingStageIds = Stage::whereIn('id', $rounds->pluck('stage_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        foreach ($rounds as $round) {
            if (! isset($existingLeagueIds[$round['league_id']]) || ! isset($existingSeasonIds[$round['season_id']]) || ! isset($existingStageIds[$round['stage_id']])) {
                continue;
            }

            Round::updateOrCreate(
                ['id' => $round['id']],
                $round,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
