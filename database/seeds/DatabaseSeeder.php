<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'f_name' => 'admin',
            'l_name' => 'admin',
            'user_name' => 'admin',
            'email' => 'admin@bh.mn',
            'phone' => '99999999',
            'admin_type' => 0,
            'status' => 1,
            'password' => bcrypt('secret'),
        ]);
    }
}
