<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->delete();
        $customers = array(
          [
              'id'=>1,
              'username'=>'admin',
              'password'=>Hash::make('pwd'),
              'email'=>'admin@mv.com',
              'mobile'=>'+9593726346',
              'display_name'=>'Administrator',
              'device_token'=>'c9ExXhiSxB4:APA91bEFaNZw1WQ6PsvwFDrhs56kdPlXHOGzMf5Xyho1goQt69aHf2ZlysgbZNBfo6hSb__EbD930k2j0JMy4sYuyFTuAo4M-ZB0UbejSWyNBGBIU3V5jvacNut1aNE5Sknys-hlNu8x',
              'platform'=>'A',
              'status'=>1,
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s')
          ],
          [
              'id'=>2,
              'username'=>'minthura',
              'password'=>Hash::make('pwd'),
              'email'=>'test1@mv.com',
              'mobile'=>'+9593726346',
              'display_name'=>'Min Thura',
              'device_token'=>'c9ExXhiSxB4:APA91bEFaNZw1WQ6PsvwFDrhs56kdPlXHOGzMf5Xyho1goQt69aHf2ZlysgbZNBfo6hSb__EbD930k2j0JMy4sYuyFTuAo4M-ZB0UbejSWyNBGBIU3V5jvacNut1aNE5Sknys-hlNu8x',
              'platform'=>'A',
              'status'=>1,
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s')
          ],
          [
              'id'=>3,
              'username'=>'arrtee',
              'password'=>Hash::make('pwd'),
              'email'=>'test2@mv.com',
              'mobile'=>'+959334344',
              'display_name'=>'Thet Naing Oo',
              'device_token'=>'c9ExXhiSxB4:APA91bEFaNZw1WQ6PsvwFDrhs56kdPlXHOGzMf5Xyho1goQt69aHf2ZlysgbZNBfo6hSb__EbD930k2j0JMy4sYuyFTuAo4M-ZB0UbejSWyNBGBIU3V5jvacNut1aNE5Sknys-hlNu8x',
              'platform'=>'A',
              'status'=>1,
              'created_at'=>date('Y-m-d H:i:s'),
              'updated_at'=>date('Y-m-d H:i:s')
          ]
        );
        DB::table('customers')->insert($customers);
    }
}
