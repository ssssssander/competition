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
            'start' => Carbon::now()->toDateString(),
            'end' => Carbon::now()->addWeek()->toDateString()
        ],
        [
            'term' => 2,
            'start' => Carbon::now()->addWeek()->toDateString(),
            'end' => Carbon::now()->addWeeks(2)->toDateString()
        ],
        [
            'term' => 3,
            'start' => Carbon::now()->addWeeks(2)->toDateString(),
            'end' => Carbon::now()->addWeeks(3)->toDateString()
        ],
        [
            'term' => 4,
            'start' => Carbon::now()->addWeeks(3)->toDateString(),
            'end' => Carbon::now()->addWeeks(4)->toDateString()
        ]]);
    }
}
