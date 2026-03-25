<?php

namespace App\Jobs\Sportmonks;

use App\Models\City;
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
class ImportCitiesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::city()
            ->setFilter('populate')
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        foreach ($response->collect('data') as $item) {
            foreach (['latitude', 'longitude'] as $field) {
                if (isset($item[$field])) {
                    $value = preg_replace('/[\x{00AD}\x{2010}-\x{2015}\x{2212}\x{FE63}\x{FF0D}]/u', '-', (string) $item[$field]);
                    $value = preg_replace('/^-{2,}/', '-', $value);
                    $item[$field] = is_numeric($value) ? (float) $value : null;
                }
            }

            City::updateOrCreate(
                ['id' => $item['id']],
                $item,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
