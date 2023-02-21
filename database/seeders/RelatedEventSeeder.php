<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RelatedEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('related_events')->updateOrInsert([
            'id' => 1
        ], [
            'link_text' => 'Induction',
            'event_type' => 1
        ]);

        DB::table('related_events')->updateOrInsert([
            'id' => 2
        ], [
            'link_text' => 'Photo Contest',
            'event_type' => 2
        ]);

        DB::table('related_events')->updateOrInsert([
            'id' => 3
        ], [
            'link_text' => 'Fellowship Night',
            'event_type' => 3
        ]);

        DB::table('related_events')->updateOrInsert([
            'id' => 4
        ], [
            'link_text' => 'Research Presentations',
            'event_type' => 4
        ]);
    }
}
