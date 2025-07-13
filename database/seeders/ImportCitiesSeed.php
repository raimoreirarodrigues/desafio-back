<?php

namespace Database\Seeders;

use App\Models\City;
use Exception;
use Illuminate\Database\Seeder;

class ImportCitiesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            if(City::count() <= 0){
                $cities_csvFile = base_path().'/database/imports/cidades.csv';
                $cities = ImportCSV::csv_to_array($cities_csvFile,',');
                $count = 1;
                foreach($cities as $index=>$cities_list){
                if($index==0){
                    continue;
                }
                foreach($cities_list as $city){
                    $city_explode = explode(";",$city);
                    City::create(['name'=>$city_explode[0],'uf'=>$city_explode[1]]);
                    $count++;
                }
                }
                $this->command->info('Total adicionados: '.$count);
            }
            
       }catch(Exception $e){
        $this->command->error($e->getMessage());
       }
    }
}
