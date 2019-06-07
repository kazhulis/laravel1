<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('Categories')->insert([
            'name' => 'Cars',
            'description' => 'The quickest way to sell your car on the internet! Sign up for free!',
        ]);
        DB::table('Categories')->insert([
            'name' => 'Furniture',
            'description' => 'Fresh furniture from the best providers in the country! Buy now!',
        ]);
        DB::table('Categories')->insert([
            'name' => 'Bicycles',
            'description' => 'Need new means of transportaion? We will hook you up with a cool bike!',
        ]);
        DB::table('Categories')->insert([
            'name' => 'Technology',
            'description' => 'We can hook you up with the freshest technologies! We guarentee quality!',
        ]);
    }

}
