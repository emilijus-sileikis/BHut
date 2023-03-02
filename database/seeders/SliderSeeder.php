<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
            [
                'title' => 'Sweeten Your Day with Our Pure Honey',
                'description' => 'Discover the natural sweetness of our pure honey products. Our e-shop offers a variety of locally sourced and sustainable honey options that are rich in flavor and packed with nutrients. From wildflower honey to honeycomb, we have everything you need to elevate your taste buds and support local beekeeping. Shop now and taste the difference!',
                'image' => 'uploads/slider/first.jpg',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Unlock the Wonder of Honey: Shop Now!',
                'description' => 'Did you know that honey is the only food that never spoils? Archaeologists have discovered jars of honey in ancient Egyptian tombs that are still edible after thousands of years! Honey also has natural antibacterial properties and can help soothe sore throats and coughs. Explore our selection of premium honey products, and discover the magic of this ancient and fascinating food. Shop now and taste the wonder of honey!',
                'image' => 'uploads/slider/second.jpg',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Bee-licious Honey Delivered to Your Doorstep',
                'description' => 'Satisfy your sweet tooth with our delicious and wholesome honey products. Our e-shop offers a range of honey varieties, all sourced from local beekeepers who prioritize sustainability and ethical practices. From honeycomb to creamed honey, we have something for everyone. Order now and enjoy the taste of pure, natural sweetness!',
                'image' => 'uploads/slider/third.png',
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
