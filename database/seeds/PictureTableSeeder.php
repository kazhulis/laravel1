<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('pictures')->insert([
                'path' => '/storage/upload/no_image.png',
                'post_id' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
