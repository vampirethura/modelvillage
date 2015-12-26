<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->delete();

        $locations = array(
            ['id'=>1, 'name'=>'Orchard Branch', 'type'=>'store', 'descr'=>'Near to the prime area...', 'country'=>'SG', 'city'=>'Singapore', 'address'=>'Somewhere avenue some place.'],
            ['id'=>2, 'name'=>'Bukit Batok Branch', 'type'=>'store', 'descr'=>'Near to the prime area...', 'country'=>'SG', 'city'=>'Singapore', 'address'=>'Somewhere avenue some place.'],
            ['id'=>3, 'name'=>'Seng Kang Branch', 'type'=>'store', 'descr'=>'Near to the prime area...', 'country'=>'SG', 'city'=>'Singapore', 'address'=>'Somewhere avenue some place.'],
            ['id'=>4, 'name'=>'Woodland Branch', 'type'=>'store', 'descr'=>'Near to the prime area...', 'country'=>'SG', 'city'=>'Singapore', 'address'=>'Somewhere avenue some place.'],
            ['id'=>5, 'name'=>'Sembawang Branch', 'type'=>'store', 'descr'=>'Near to the prime area...', 'country'=>'SG', 'city'=>'Singapore', 'address'=>'Somewhere avenue some place.']
        );


        DB::table('locations')->insert($locations);
    }
}
