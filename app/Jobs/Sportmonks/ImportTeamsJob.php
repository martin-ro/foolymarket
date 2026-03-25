<?php

namespace App\Jobs\Sportmonks;

use App\Models\Team;
use App\Models\Venue;
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
class ImportTeamsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly int $seasonId,
        private readonly int $page = 1,
    ) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::team()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->bySeasonId($this->seasonId);

        $teams = $response->collect('data');

        $existingVenueIds = Venue::whereIn('id', $teams->pluck('venue_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        foreach ($teams as $team) {
            if (isset($team['venue_id']) && ! isset($existingVenueIds[$team['venue_id']])) {
                $team['venue_id'] = null;
            }

            Team::updateOrCreate(
                ['id' => $team['id']],
                $team,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->seasonId, $this->page + 1);
        }
    }
}
