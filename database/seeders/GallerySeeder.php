<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = CarbonImmutable::now();

        DB::table('galleries')->insert([
            [
                'filename' => 'cutting.jpg',
                'created_at' => $now->subMinutes(6),
                'updated_at' => $now->subMinutes(6),
            ],
            [
                'filename' => 'cutting1.jpg',
                'created_at' => $now->subMinutes(5),
                'updated_at' => $now->subMinutes(5),
            ],
            [
                'filename' => 'editing.jpg',
                'created_at' => $now->subMinutes(4),
                'updated_at' => $now->subMinutes(4),
            ],
            [
                'filename' => 'Printingpola.jpg',
                'created_at' => $now->subMinutes(3),
                'updated_at' => $now->subMinutes(3),
            ],
            [
                'filename' => 'semple.jpg',
                'created_at' => $now->subMinutes(2),
                'updated_at' => $now->subMinutes(2),
            ],
            [
                'filename' => 'sewing.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
