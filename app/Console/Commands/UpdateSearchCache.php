<?php

namespace App\Console\Commands;

use App\SongListComposer;
use Cache;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateSearchCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'beatsaver:update-search-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update search cache to speed up searches';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->top100();
    }

    protected function top100()
    {
        $composer = new SongListComposer;
        $now = Carbon::now();

        if (config('beatsaver.cache.top100.newest')) {
            Cache::tags(['top100'])->put('newest', ['keys' => $composer->getNewestKeys(0, 100), 'updated' => $now], config('beatsaver.cache.duration'));
        }
        if (config('beatsaver.cache.top100.downloads')) {
            Cache::tags(['top100'])->put('downloads', ['keys' => $composer->getTopDownloadedKeys(0, 100), 'updated' => $now], config('beatsaver.cache.duration'));
        }
        if (config('beatsaver.cache.top100.played')) {
            Cache::tags(['top100'])->put('played', ['keys' => $composer->getTopPlayedKeys(0, 100), 'updated' => $now], config('beatsaver.cache.duration'));
        }
        if (config('beatsaver.cache.top100.rated')) {
            Cache::tags(['top100'])->put('rated', ['keys' => $composer->getTopRatedKeys(0, 100), 'updated' => $now], config('beatsaver.cache.duration'));
        }
    }
}
