<?php

use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert(
            [[
                'title' => "Học vui mỗi ngày",
                'content' => 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAallllcamamccasasd',
                'level' => 3,
                'start_date' => date('Y-m-d',time()),
                'end_date' => date('Y-m-d',time()+3600),
                'group_id' => 3,
                'status' => 0,
                'author' => 4
            ],
            [
            'title' => "Dự báo thời tiết",
                'content' => 'NẮng to độ ẩm cao ',
                'level' => 2,
                'start_date' => date('Y-m-d',time()),
                'end_date' => date('Y-m-d',time()+3600),
                'group_id' => 3,
                'status' => 0,
                'author' => 5
            ],
        [
            'title' => "Dịch covid đang hoành hành",
            'content' => 'AAAAAAAAAAAAAAAAdllplkpkpokpopokpopojzmbcbzcjhuygyugdqwg',
            'level' => 1,
            'start_date' => date('Y-m-d',time()),
            'end_date' => date('Y-m-d',time()+3600),
            'group_id' => 3,
            'status' => 0,
            'author' => 6
        ]]
        );
    }
}
