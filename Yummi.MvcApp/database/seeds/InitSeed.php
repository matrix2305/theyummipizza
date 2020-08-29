<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider as Faker;
use Illuminate\Support\Facades\Hash;

class InitSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Faker\Uuid::uuid(),
            'username' => 'admin',
            'email' => 'admin@theyummipizza.com',
            'password' => Hash::make('12345678'),
            'role_role' => 0,
            'created_at' => Faker\DateTime::dateTime()
        ]);

        $user = DB::table('users')->get()->first();

        DB::table('persons')->insert([
            'id' => Faker\Uuid::uuid(),
            'user_id' => $user->id,
            'name' => 'admin',
            'last_name' => 'admin',
            'address_street' => 'Quiddestraße',
            'address_number' => '40',
            'address_town' => 'Munich',
            'phone_phone' => '38765346376'
        ]);
    }
}
