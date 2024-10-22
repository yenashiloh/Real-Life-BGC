<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'first_name' => 'Pearloucelle',
                'last_name' => 'Buenaventura',
                'email' => 'pearl@gmail.com',
                'password' => bcrypt('adminpassword'), 
                'contact_number' => '09659865359',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
