<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class HorizonClearCommand extends Command
{
    protected $signature = 'horizon:clear-all';

    public function handle(): void
    {
        Redis::connection(name: 'horizon')->client()->flushAll();

        DB::table('job_batches')->delete();

        Redis::connection()->del([config('horizon.prefix').'failed:*']);
        Redis::connection()->del([config('horizon.prefix').'failed_jobs']);

        $this->info('Horizon cleared.');
    }
}
