<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'superadmin',
             'email' => 'superadmin@trackr.com',
             'password' => Hash::make('trackr'),
             'role' => 'superadmin',
         ]);

        \App\Models\User::factory()->create([
            'name' => 'BolAdmin',
            'email' => 'bol.admin@trackr.com',
            'password' => Hash::make('trackr'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Tim',
            'email' => 'tim@trackr.com',
            'password' => Hash::make('trackr'),
            'role' => 'packer',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Luuk',
            'email' => 'luuk@trackr.com',
            'password' => Hash::make('trackr'),
            'role' => 'recipient',
        ]);

        \App\Models\Shop::factory()->create([
            'name' => 'Bol.com',
            'streetname' => 'Papendorpseweg',
            'housenumber' => '100',
            'zipcode' => '3528BJ',
            'city' => 'Utrecht',
        ]);

        \App\Models\Shop::factory()->create([
            'name' => 'Wehkamp',
            'streetname' => 'Burgemeester Roelenweg',
            'housenumber' => '13',
            'zipcode' => '8021EV',
            'city' => 'Zwolle',
        ]);

        \App\Models\Shop::factory()->create([
            'name' => 'Coolblue',
            'streetname' => 'Aalsterweg',
            'housenumber' => '91',
            'zipcode' => '5615CC',
            'city' => 'Eindhoven',
        ]);

        DB::table('shop_user')->insert(
            [
                'user_id' => '2',
                'shop_id' => '1',
            ]
        );

        \App\Models\Package::factory()->create([
            'email' => 'joost@hotmail.com',
            'firstname' => 'Joost',
            'lastname' => 'Sijm',
            'streetname' => 'Wormstraat',
            'housenumber' => '73',
            'zipcode' => '1337BH',
            'city' => 'Wervershoof',
            'shop_id' => '1',
        ]);

        \App\Models\Package::factory()->create([
            'email' => 'sjoerd@trackr.com',
            'firstname' => 'Sjoerd',
            'lastname' => 'Janssen',
            'streetname' => 'Pierlaan',
            'housenumber' => '21',
            'zipcode' => '4683JF',
            'city' => 'Ede',
            'shop_id' => '1',
            'pairing_code' => '2b7b2527-b372-46aa-a79f-a61d0b5889a8',
        ]);
    }
}
