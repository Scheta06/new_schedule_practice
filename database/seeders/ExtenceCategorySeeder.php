<?php

namespace Database\Seeders;

use App\Models\ExtenceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtenceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = config('constants.seed.ExtenceCategorySeeder');

        foreach($array as $item) {
            ExtenceCategory::create($item);
        }
    }
}
