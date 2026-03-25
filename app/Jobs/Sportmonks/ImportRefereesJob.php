<?php

namespace App\Jobs\Sportmonks;

use App\Models\City;
use App\Models\Referee;
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
class ImportRefereesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::referee()
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        $referees = $response->collect('data');

        $existingCityIds = City::whereIn('id', $referees->pluck('city_id')->filter()->unique())
            ->pluck('id')
            ->flip();

        foreach ($referees as $referee) {
            if (isset($referee['city_id']) && ! isset($existingCityIds[$referee['city_id']])) {
                $referee['city_id'] = null;
            }

            Referee::updateOrCreate(
                ['id' => $referee['id']],
                $referee,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
