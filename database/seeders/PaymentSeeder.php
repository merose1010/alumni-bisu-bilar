<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_settings')->insert([
            'reciever_name' => 'John Christian',
            'gcash_no' => 'Narbaja',
            'alumni_id_price' => '250',
            'alumni_mem_price' => '300',
            'gcash_qr' => 'narbajajcs@gmail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
