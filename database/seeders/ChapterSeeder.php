<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 1
        ], [
            'chapter_name' => 'Northern Luzon'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 2
        ], [
            'chapter_name' => 'Central Luzon'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 3
        ], [
            'chapter_name' => 'Southern Luzon'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 4
        ], [
            'chapter_name' => 'NCR'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 5
        ], [
            'chapter_name' => 'Cebu'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 6
        ], [
            'chapter_name' => 'Negros'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 7
        ], [
            'chapter_name' => 'Panay Island'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 8
        ], [
            'chapter_name' => 'Southern Mindanao'
        ]);

        DB::table('pcr_chapters')->updateOrInsert([
            'id' => 9
        ], [
            'chapter_name' => 'Northern Mindanao'
        ]);
    }
}
