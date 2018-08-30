<?php

use Illuminate\Database\Seeder;
use App\Models\Owners;
use Carbon\Carbon;

class OwnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owners::truncate();
        $owners = [
            ['id' => 1, 'name' => 'user', 'created_at' => Carbon::now()],
            ['id' => 2, 'name' => 'vm', 'created_at' => Carbon::now()]
        ];
        Owners::insert($owners);
    }
}
