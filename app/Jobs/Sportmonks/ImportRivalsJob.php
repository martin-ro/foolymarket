<?php

namespace App\Jobs\Sportmonks;

use App\Models\Rival;
use App\Models\Team;
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
class ImportRivalsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::rival()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        $rivals = $response->collect('data');

        $referencedTeamIds = $rivals->flatMap(fn ($rival) => [$rival['team_id'], $rival['rival_id']])->filter()->unique();

        $existingTeamIds = Team::whereIn('id', $referencedTeamIds)
            ->pluck('id')
            ->flip();

        foreach ($rivals as $rival) {
            if (! isset($existingTeamIds[$rival['team_id']]) || ! isset($existingTeamIds[$rival['rival_id']])) {
                continue;
            }

            Rival::updateOrCreate(
                ['id' => $rival['id']],
                $rival,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
