<?php

use Illuminate\Database\Seeder;
use App\Models\Products;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();
        $owners = [
            ['name' => 'Чай', 'price' => 13, 'count' => 10, 'created_at' => Carbon::now()],
            ['name' => 'Кофе', 'price' => 18, 'count' => 20, 'created_at' => Carbon::now()],
            ['name' => 'Кофе с молоком', 'price' => 21, 'count' => 20, 'created_at' => Carbon::now()],
            ['name' => 'Сок', 'price' => 35, 'count' => 15, 'created_at' => Carbon::now()],
        ];
        Products::insert($owners);
    }
}
