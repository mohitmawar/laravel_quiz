<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable("users")) {
            DB::table('users')->insert([
                'name' => 'user_'.Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('123456789'),
            ]);
            
        }
    }
}
