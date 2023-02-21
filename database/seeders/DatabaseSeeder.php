<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call([
            // AdminTypeSeeder::class,
            // TagSeeder::class,
            // ChapterSeeder::class,
            // MembershipTypeSeeder::class,
            // NonMemberTypeSeeder::class,
            // SponsorTypeSeeder::class,
            // RegistrationTypeSeeder::class,
            // UserSeeder::class,
            // RelatedEventSeeder::class,
            // OrderStatusSeeder::class,
            // IdeapayStatusSeeder::class,
            // SpecialtyDivisionMembershipSeeder::class,
            // AffiliateSocietyMembershipSeeder::class,
            // AnnualMembershipFeesSeeder::class,
            OrderTypeSeeder::class,
            // PaymentMethodSeeder::class
            // CollectionFeeSeeder::class,
        ]);
    }
}
