<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'name' => 'Thể loại',
                'parent_id' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Quốc gia',
                'parent_id' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ',
                'parent_id' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim bộ',
                'parent_id' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim hành động',
                'parent_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim kinh dị',
                'parent_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim tình cảm',
                'parent_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim viễn tưởng',
                'parent_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim tâm lý',
                'parent_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Trung Quốc',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Thái Lan',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Việt Nam',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Hàn Quốc',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Nhật Bản',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim Mỹ',
                'parent_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim bộ Hàn Quốc',
                'parent_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim bộ Nhật Bản',
                'parent_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim bộ Mỹ',
                'parent_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2019',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2018',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2017',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2016',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2015',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2014',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phim lẻ 2013',
                'parent_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
        $menus = App\Menu::all();
        foreach ($menus as $menu) {
            DB::table('menus')
                ->where("name", $menu->name)
                ->update([
                    'slug' => Str::slug($menu->name)
                ]);
        }
    }
}
