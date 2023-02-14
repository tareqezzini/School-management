<?php
use App\Models\Nationalitie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();
        $Nats = ['Yemeni','Yemeni','Emirati','Tunisian','Syrian','Sudanese','Somali','Saudi Arabian','Qatari','Palestinian','Omani','Mauritanian','Libyan','Lebanese','Kuwaiti','Jordanian','Iraqi','Egyptian','Djiboutian','Comorian','Bahraini','Algerian'];
        foreach($Nats as $Nat)
        {
            Nationalitie::create(['Name' => $Nat]);
        }
    }
}
