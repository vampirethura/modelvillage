<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $settings = array(
            ['type'=>'LocationType','type_label'=>'Store Type', 'key'=>'store', 'value'=>'Store'],
            ['type'=>'LocationType','type_label'=>'Store Type', 'key'=>'branch', 'value'=>'Branch'],
            ['type'=>'LocationType','type_label'=>'Store Type', 'key'=>'main', 'value'=>'Main'],
            ['type'=>'ActivationStatusType','type_label'=>'Activation Status', 'key'=>'A', 'value'=>'Activated'],
            ['type'=>'ActivationStatusType','type_label'=>'Activation Status', 'key'=>'I', 'value'=>'Not Activated'],
            ['type'=>'ItemCategory','type_label'=>'Item Category', 'key'=>'food', 'value'=>'Food'],
            ['type'=>'ItemCategory','type_label'=>'Item Category', 'key'=>'beverages', 'value'=>'Beverages'],
            ['type'=>'ItemCategory','type_label'=>'Item Category', 'key'=>'dessert', 'value'=>'Dessert'],
            ['type'=>'ItemCategory','type_label'=>'Item Category', 'key'=>'snack', 'value'=>'Snack'],
            ['type'=>'Department','type_label'=>'Department', 'key'=>'hr', 'value'=>'Human Resource'],
            ['type'=>'Department','type_label'=>'Department', 'key'=>'sales', 'value'=>'Sales'],
            ['type'=>'Department','type_label'=>'Department', 'key'=>'marketing', 'value'=>'Marketing'],
            ['type'=>'Department','type_label'=>'Department', 'key'=>'support', 'value'=>'Support'],
            ['type'=>'Department','type_label'=>'Department', 'key'=>'it', 'value'=>'IT'],
            ['type'=>'UserAccountType','type_label'=>'User Account Type', 'key'=>'staff', 'value'=>'Staff'],
            ['type'=>'UserAccountType','type_label'=>'User Account Type', 'key'=>'individual', 'value'=>'Individual'],
            ['type'=>'UserAccountType','type_label'=>'User Account Type', 'key'=>'corporate', 'value'=>'Corporate'],
            ['type'=>'PaymentStatus','type_label'=>'Payment Status', 'key'=>'paid', 'value'=>'Paid'],
            ['type'=>'PaymentStatus','type_label'=>'Payment Status', 'key'=>'not_paid', 'value'=>'Not Paid'],
            ['type'=>'DeliveryStatus','type_label'=>'Delivery Status', 'key'=>'delivered', 'value'=>'Delivered'],
            ['type'=>'DeliveryStatus','type_label'=>'Pending', 'key'=>'pending', 'value'=>'Pending']
        );

        DB::table('settings')->insert($settings);
    }
}
