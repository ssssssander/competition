<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert([
        [
            'term' => 1,
            'start' => Carbon::create(2017, 12, 1),
            'end' => Carbon::create(2017, 12, 1)->addWeek()
        ],
        [
            'term' => 2,
            'start' => Carbon::create(2017, 12, 8),
            'end' => Carbon::create(2017, 12, 8)->addWeek()
        ],
        [
            'term' => 3,
            'start' => Carbon::create(2017, 12, 15),
            'end' => Carbon::create(2017, 12, 15)->addWeek()
        ],
        [
            'term' => 4,
            'start' => Carbon::create(2017, 12, 21),
            'end' => Carbon::create(2017, 12, 21)->addWeek()
        ]]);
    }
}
