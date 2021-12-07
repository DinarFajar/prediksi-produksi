<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        DB::table('templates')->insert([
            'name' => 'ABC',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
