<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weight_target')->insert([
            'user_id' => 1,
            'target_weight' => 60.0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //
    }
}
