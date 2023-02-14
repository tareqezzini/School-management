<?php

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $genders = ['Male' , 'Female'];

        foreach($genders as $gender)
        {
            Gender::create(['Name' => $gender]);
        }
    }
}
