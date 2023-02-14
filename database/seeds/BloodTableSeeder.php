<?php

use App\Models\TypeBlood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_bloods')->delete();
        $typeBloods =  ['A+' , 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        foreach($typeBloods as $typeBlood)
        {
            TypeBlood::create([
                'Name'=> $typeBlood
            ]);
            
        }
    }
}
