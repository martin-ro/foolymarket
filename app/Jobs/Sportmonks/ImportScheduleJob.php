<?php

namespace App\Jobs\Sportmonks;

use App\Models\Fixture;
use App\Models\Round;
use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PyaeSoneAung\SportmonksFootballApi\Facades\SportmonksFootballApi;

class ImportScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $seasonId) {}

    public function handle(): void
    {
        $data = SportmonksFootballApi::schedule()
            ->bySeasonId($this->seasonId)
            ->collect('data');

        $rounds = $data->pluck('rounds')->flatten(1);

        $rounds->each(function (array $round): void {
            Round::updateOrCreate(
                ['id' => $round['id']],
                collect($round)->except('fixtures')->toArray(),
            );

            collect($round['fixtures'])->each(function (array $fixture): void {
                Fixture::updateOrCreate(
                    ['id' => $fixture['id']],
                    collect($fixture)->except(['participants', 'scores'])->toArray(),
                );

                collect($fixture['scores'] ?? [])->each(function (array $score): void {
                    Score::updateOrCreate(
                        ['id' => $score['id']],
                        $score,
                    );
                });
            });
        });
    }
}
