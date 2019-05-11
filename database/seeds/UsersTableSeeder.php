<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table("users")->insert(
            [
	            "name" => "admin",
            	"username" => "admin",
	            "phone" => "0000",
	            "password" => bcrypt("babovka"),
	            "isAdmin" => 1,
            ]
        );
    }
}
