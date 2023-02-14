<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
       User::create([
           'name' => "Tareq",
            'email' => "admin@gamil.com",
            'password' => Hash::make("123456")
       ]);
    }
}