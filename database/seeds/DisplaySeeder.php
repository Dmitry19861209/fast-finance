<?php

use Illuminate\Database\Seeder;
use App\Models\Display;
use Carbon\Carbon;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Display::truncate();
        $display = [
            ['pay_sum' => 0, 'created_at' => Carbon::now()]
        ];
        Display::insert($display);
    }
}
