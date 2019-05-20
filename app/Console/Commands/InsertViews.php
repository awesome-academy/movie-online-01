<?php

namespace App\Console\Commands;

use App\View;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class InsertViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert/Update views of films';

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
        $redis = Redis::connection();
        $key = $redis->keys('view:*');

        foreach ($key as $value) {
            $views = Redis::get($value);
            $date = str_after(str_after($value, 'film_id_'), ':');
            $film_id = str_before(str_after($value, 'film_id_'), ':');

            View::updateOrCreate(
                [
                    'film_id' => $film_id,
                    'date' => $date,
                ], 
                [
                    'film_id' => $film_id,
                    'views' => $views,
                    'date' => $date,
                ]
            );
        }
        $this->info( __('Update views of films successfuly!') );
    }
}
