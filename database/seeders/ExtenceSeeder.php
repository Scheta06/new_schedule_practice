<?php

namespace Database\Seeders;

use App\Models\Extence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = config('constants.seed.ExtenceSeeder');

        foreach($array as $item) {
            Extence::create($item);
        }
    }
}
