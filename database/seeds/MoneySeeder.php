<?php

use Illuminate\Database\Seeder;
use App\Models\Money;
use Carbon\Carbon;

class MoneySeeder extends Seeder
{
    const OWNER_USER = 1;
    const OWNER_VM = 2;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Money::truncate();
        $owners = [
            ['owner_id' => self::OWNER_USER, 'value' => 1, 'count' => 10, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_USER, 'value' => 2, 'count' => 30, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_USER, 'value' => 5, 'count' => 20, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_USER, 'value' => 10, 'count' => 15, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_VM, 'value' => 1, 'count' => 100, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_VM, 'value' => 2, 'count' => 100, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_VM, 'value' => 5, 'count' => 100, 'created_at' => Carbon::now()],
            ['owner_id' => self::OWNER_VM, 'value' => 10, 'count' => 100, 'created_at' => Carbon::now()],
        ];
        Money::insert($owners);
    }
}
