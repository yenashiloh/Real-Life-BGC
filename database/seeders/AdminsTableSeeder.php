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
                'first_name' => 'REAL LIFE',
                'last_name' => 'BGC',
                'email' => 'bgc@reallife.ph',
                'password' => bcrypt('RealLifeBGC2024'), 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
