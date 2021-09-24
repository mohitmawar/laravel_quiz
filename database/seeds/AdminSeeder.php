<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable("admins")) {
            DB::table('admins')->insert([
                'name' => 'admin',
                'role' => '1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
            ]);
            
        }
    }
}

