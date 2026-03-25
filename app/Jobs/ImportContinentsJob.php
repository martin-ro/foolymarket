<?php

namespace App\Jobs;

use App\Models\Continent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PyaeSoneAung\SportmonksFootballApi\Facades\SportmonksFootballApi;

class ImportContinentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $page = 1;

        do {
            $response = SportmonksFootballApi::continent()
                ->setPerPage(50)
                ->setPage($page)
                ->all();

            $seasons = $response->collect('data');

            foreach ($seasons as $season) {
                Continent::updateOrCreate(
                    ['id' => $season['id']],
                    $season,
                );
            }

            $page++;
        } while ($response->pagination()->has_more === true);
    }
}
