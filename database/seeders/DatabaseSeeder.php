<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'credit review admin',
                'created_at' => now(),
            ],
            [
                'name' => 'credit reviewer',
                'created_at' => now(),
            ],
            [
                'name' => 'senior credit review',
                'created_at' => now(),
            ],
            [
                'name' => 'credit review division head',
                'created_at' => now(),
            ],
        ]);

        DB::table('segmentations')->insert([
            [
                'name' => 'S.M.E.',
                'created_at' => now(),
            ],
            [
                'name' => 'commercial',
                'created_at' => now(),
            ],
        ]);
    }
}
