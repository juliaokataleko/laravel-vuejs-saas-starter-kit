<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $angolaLocations = array(
            "Bengo" => array("Ambriz", "Bula Atumba", "Dande", "Demba Chio", "Nambuangongo", "Pango Aluquém"),
            "Benguela" => array("Balombo", "Baía Farta", "Benguela", "Bocoio", "Caimbambo", "Catumbela", "Chongorói", "Cubal", "Ganda", "Lobito"),
            "Bié" => array("Andulo", "Camacupa", "Catabola", "Chinguar", "Chitembo", "Cuemba", "Cunhinga", "Kuito", "Nharea"),
            "Cabinda" => array("Buco-Zau", "Belize", "Cabinda", "Cacongo"),
            "Kuando Kubango" => array("Calai", "Cuangar", "Cuchi", "Cuito Cuanavale", "Dirico", "Mavinga", "Menongue", "Nancova", "Rivungo"),
            "Kuanza Norte" => array("Ambaca", "Banga", "Bolongongo", "Cambambe", "Golungo Alto", "Lucala", "Quiculungo", "Samba Caju", "Gonguembo", "Cazengo"),
            "Kuanza Sul" => array("Amboim", "Cassongue", "Conda", "Ebo", "Libolo", "Mussende", "Porto Amboim", "Quibala", "Quilenda", "Seles", "Sumbe", "Waku Kungo"),
            "Cunene" => array("Cahama", "Cuanhama", "Curoca", "Cuvelai", "Ombandja", "Ondjiva"),
            "Huambo" => array("Bailundo", "Cachiungo", "Caála", "Ekunha", "Huambo", "Londuimbale", "Longonjo", "Mungo", "Tchicala Tcholoanga", "Tchindjenje", "Ucuma"),
            "Huíla" => array("Caconda","Cacula","Caluquembe","Chiange","Chibia","Chicomba","Chipindo","Humpata","Jamba","Kuvango","Lubango","Matala","Quilengues","Quipungo"),
            "Luanda" => array("Icolo-e-Bengo", "Luanda", "Quiçama", "Cacuaco", "Cazenga", "Viana", "Belas", "Kilamba Kiaxi", "Talatona"),
            "Lunda Norte" => array("Cambulo", "Capenda-Camulemba", "Caungula", "Chitato", "Cuango", "Cuilo", "Dundo", "Lóvua", "Lubalo", "Lucapa"),
            "Lunda Sul" => array("Cacolo", "Dala", "Muconda", "Saurimo"),
            "Malanje" => array("Cacuso","Calandula","Cambundi-Catembo","Cangandala","Caombo","Cuaba Nzogo", "Cunda-Diaza", "Luquembo","Malanje","Marimba","Massango","Caculama-Mucari","Quela","Quirima"),
            "Moxico" => array("Alto Zambeze", "Bundas", "Camanongue", "Leua", "Luau", "Luchazes", "Cameia", "Luacano", "Moxico ou Luena"),
            "Namibe" => array("Bibala", "Camucuio", "Moçâmedes", "Tombwa", "Virei"),
            "Uíge" => array("Alto Cauale","Ambuíla","Bembe","Buengas","Bungo","Damba","Macocola","Mucaba","Negage","Puri","Quimbele","Quitexe","Sanza Pombo","Songo","Uíge","Maquela do Zombo"),
            "Zaire" => array("M'banza Kongo", "N'zeto", "Noqui", "Soyo", "Tomboco", "Cuimba"),
        );

        $country = [
            'name' => 'Angola',
            'code' => 'AO',
            'slug' => Str::slug('Angola'),
            'currency' => 'Kwanza',
            'currency_code' => 'AKZ'
        ];

        $country = Country::query()->create($country);

        foreach ($angolaLocations as $key => $cities) {
            $province = State::query()->create([
                'name'=>$key,
                'slug'=>Str::slug($key),
                'country_id'=>$country->id
            ]);

            foreach ($cities as $key => $city) {
                $city = City::query()->create([
                    'name'=>$city,
                    'slug'=>Str::slug($city),
                    'country_id'=>$country->id,
                    'state_id'=>$province->id
                ]);
            }
        }
    }
}
