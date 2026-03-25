<?php

namespace App\Jobs;

use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PyaeSoneAung\SportmonksFootballApi\Facades\SportmonksFootballApi;

class ImportCountriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $page = 1;

        do {
            $response = SportmonksFootballApi::country()
                ->setPerPage(50)
                ->setPage($page)
                ->all();

            $items = $response->collect('data');

            foreach ($items as $item) {
                Country::updateOrCreate(
                    ['id' => $item['id']],
                    $item,
                );
            }

            $page++;
        } while ($response->pagination()->has_more === true);
    }
}
