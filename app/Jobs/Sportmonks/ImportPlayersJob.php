<?php

namespace App\Jobs\Sportmonks;

use App\Models\City;
use App\Models\Player;
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
class ImportPlayersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::player()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        $players = $response->collect('data');

        $existingCityIds = City::whereIn('id', $players->pluck('city_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        foreach ($players as $player) {
            if (isset($player['city_id']) && ! isset($existingCityIds[$player['city_id']])) {
                $player['city_id'] = null;
            }

            Player::updateOrCreate(
                ['id' => $player['id']],
                $player,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
