<?php

use Illuminate\Database\Seeder;

class OrderstatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('order_statuses')->insert([

            [
                'name' => 'Created',
                'description' => 'Order has been created',
            ],
            [
                'name' => 'Booked',
                'description' => 'Order has been booked',
            ],
            [
                'name' => 'Delivered',
                'description' => 'Order has been delivered to the customer',
            ],
            [
                'name' => 'Delivered',
                'description' => 'Order has been cancelled',
            ],
           

        ]);
    }
}
