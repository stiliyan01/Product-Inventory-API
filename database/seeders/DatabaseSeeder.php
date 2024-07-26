<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\CategoryProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Name Admin',
            'email' => 'admin@abv.bg',
            'password' => bcrypt('password'),
            'type' => 'admin'
        ]);


        User::factory(9)->create();
        Category::factory(5)->create();
        Product::factory(20)->create();
        Order::factory(10)->create();

        CategoryProduct::factory(20)->create();
        OrderProduct::factory(10)->create();
    }
}