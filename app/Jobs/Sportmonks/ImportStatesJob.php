<?php

namespace App\Jobs\Sportmonks;

use App\Models\State;
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
class ImportStatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly int $page = 1) {}

    public function handle(): void
    {
        $response = SportmonksFootballApi::state()
            ->setFilter('populate')
            ->setPerPage(1000)
            ->setPage($this->page)
            ->all();

        foreach ($response->collect('data') as $item) {
            State::updateOrCreate(
                ['id' => $item['id']],
                $item,
            );
        }

        if ($response->pagination()->has_more === true) {
            static::dispatch($this->page + 1);
        }
    }
}
