<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candle_category_id = DB::table('categories')->insertGetId([
            'name' => 'Candle',
            'slug' => 'candle',
            'description' => 'This is the candle category',
            'image' => 'uploads/category/first.png',
            'meta_title' => 'Candle',
            'meta_keyword' => 'This is the candle category',
            'meta_description' => 'This is the candle category',
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $honey_category_id = DB::table('categories')->insertGetId([
            'name' => 'Honey',
            'slug' => 'honey',
            'description' => 'This is the honey category',
            'image' => 'uploads/category/second.png',
            'meta_title' => 'Honey',
            'meta_keyword' => 'This is the honey category',
            'meta_description' => 'This is the honey category',
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $soap_category_id = DB::table('categories')->insertGetId([
            'name' => 'Soap',
            'slug' => 'soap',
            'description' => 'This is the soap category',
            'image' => 'uploads/category/third.png',
            'meta_title' => 'Soap',
            'meta_keyword' => 'This is the soap category',
            'meta_description' => 'This is the soap category',
            'status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('products')->insert([
            [
                'category_id' => $candle_category_id,
                'name' => 'Beeswax Candle',
                'slug' => 'beeswax-candle',
                'small_description' => 'This is a candle made out of beeswax.',
                'description' => 'This is a candle made out of beeswax.',
                'original_price' => 13.99,
                'selling_price' => 11.99,
                'quantity' => 10,
                'trending' => 0,
                'status' => 0,
                'meta_title' => 'Beeswax Candle',
                'meta_keyword' => 'This is a candle made out of beeswax.',
                'meta_description' => 'This is a candle made out of beeswax.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $candle_category_id,
                'name' => 'Beeswax Jar Candle',
                'slug' => 'beeswax-jar-candle',
                'small_description' => 'This is a candle made out of beeswax and put into a jar.',
                'description' => 'This is a candle made out of beeswax and put into a jar.',
                'original_price' => 24.99,
                'selling_price' => 20,
                'quantity' => 2,
                'trending' => 0,
                'status' => 0,
                'meta_title' => 'Beeswax Jar Candle',
                'meta_keyword' => 'This is a candle made out of beeswax and put into a jar.',
                'meta_description' => 'This is a candle made out of beeswax and put into a jar.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $honey_category_id,
                'name' => 'Mint Honey',
                'slug' => 'mint-honey',
                'small_description' => 'This is mint honey.',
                'description' => 'This is mint honey.',
                'original_price' => 19.99,
                'selling_price' => 16.99,
                'quantity' => 5,
                'trending' => 1,
                'status' => 0,
                'meta_title' => 'Mint Honey',
                'meta_keyword' => 'This is mint honey.',
                'meta_description' => 'This is mint honey.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
