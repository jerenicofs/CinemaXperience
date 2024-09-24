<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WatchPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('watch_parties')->insert([
            [
                'name' => 'Party1',
                'media_id' => '1',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Party2',
                'media_id' => '2',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Party3',
                'media_id' => '3',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

    }
}
