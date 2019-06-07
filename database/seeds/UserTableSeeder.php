<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('Users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@marketplace.lv',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'), // password
            'remember_token' => Str::random(10),
            'role' => 2,
        ]);
        factory('App\User', 50)->create();
    }

}
