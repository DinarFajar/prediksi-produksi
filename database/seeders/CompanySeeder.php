<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table('companies')->insert([
            'about' => Storage::get('public/about/about.txt'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
