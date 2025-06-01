<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MarkSeeder::class,
            PatternSeeder::class,
            GenerationSeeder::class,
            CarSeeder::class,
            ExtenceCategorySeeder::class,
            ExtenceSeeder::class,
        ]);
    }
}
