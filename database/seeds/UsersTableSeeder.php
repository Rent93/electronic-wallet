<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' 			=> 'Nguyễn Minh Tuấn',
            'username' 		=> 'admin',
            'email' 		=> 'tuan.ltv.110893@gmail.com',
            'password' 		=> bcrypt('minhtuan123'),
        ]);
    }
}
