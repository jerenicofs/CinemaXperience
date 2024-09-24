<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WatchPartyParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = DB::table('users')->where('role', 'member')->pluck('id');
        $partyIds = DB::table('watch_parties')->pluck('id');

        $participants = [];
        $currentTime = now();

        foreach ($members as $memberId) {
            foreach ($partyIds as $partyId) {
                if (rand(0, 2)) {
                    $participants[] = [
                        'user_id' => $memberId,
                        'watch_parties_id' => $partyId,
                        'status' => 'joined',
                        'joined_at' => $currentTime,
                        'created_at' => $currentTime,
                        'updated_at' => $currentTime
                    ];
                }
            }
        }

        DB::table('watch_parties_participants')->insert($participants);
    }
}
