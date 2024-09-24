<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


Class FriendSeeder extends Seeder
{
    public function run(): void{
        DB::table('user_friend_lists')->insert([
        [
            'user_id' => '3',
            'friend_id' => '2',
            'status' => 'accepted',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'user_id' => '2',
            'friend_id' => '4',
            'status' => 'accepted',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'user_id' => '2',
            'friend_id' => '6',
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ],
        [
            'user_id' => '4',
            'friend_id' => '3',
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]
        ]);
    }
}
