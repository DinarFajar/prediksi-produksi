<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $now = now();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('admin'),
                'role' => 'ADMIN',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dinar',
                'email' => 'mdinarfajar@gmail.com',
                'email_verified_at' => $now,
                'password' => Hash::make('dinar'),
                'role' => 'KEPALA_PRODUKSI',
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
