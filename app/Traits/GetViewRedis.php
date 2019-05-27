<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Carbon;

trait GetViewRedis {

    public function getViewsOfWeek()
    {
        $carbon = new Carbon;
        $dayOfWeek = Carbon::now()->dayOfWeek;
        $week = $carbon->subDay($dayOfWeek);
        $redis = Redis::connection();
        $key = $redis->keys('view:*');
        foreach ($key as $value) {
            $date = str_after(str_after($value, 'film_id_'), ':');
            $film_id = str_before(str_after($value, 'film_id_'), ':');
            $views = Redis::get($value);
            /*
             * Check date of week
             * Convert and merge $film_id, $views to array
            */
            if ($date >= $week) {
                $viewRedis[] = [
                    'film_id' => $film_id,
                    'views' => $views,
                ];
            }  
        }
        /*
         * Merge values of the duplicate keys
        */
        foreach ($viewRedis as $key => $value) {
            $id = $value['film_id'];
            $mergeValue[$id][] = $value['views'];
        }
        /*
         * Sum values of keys
        */
        foreach ($mergeValue as $key => $value) {
            $new_view_array[] = [
                'id' => $key,
                'views' => array_sum($value),
            ];
        }
        
        return $new_view_array;
    }

    public function mergeFilmWithView($film, $new_view_array)
    {
        foreach ($film as $key_1 => $val_1) {
            $result[] = $val_1 + ['views' => 0];
            foreach ($new_view_array as $key_2 => $val_2) {
                if ($val_1['id'] == $val_2['id']) {
                   $result[$key_1] = $val_1 + ['views' => $val_2['views']];
                }
            }
        }
        $data = collect($result);

        return $data->sortByDesc('views');
    }
}
