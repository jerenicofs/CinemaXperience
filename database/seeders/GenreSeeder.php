<?php

namespace Database\Seeders;

use App\Models\Genre;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon as SupportCarbon;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $time = SupportCarbon::now();
        $genres = [
            ['genre_type' => 'korean-drama', 'created_at' => $time, 'updated_at' => $time],
            ['genre_type' => 'action', 'created_at' => $time, 'updated_at' => $time],
            ['genre_type' => 'melodrama', 'created_at' => $time, 'updated_at' => $time],
            ['genre_type' => 'romantic-comedy', 'created_at' => $time, 'updated_at' => $time],
            ['genre_type' => 'thriller', 'created_at' => $time, 'updated_at' => $time]
        ];

        Genre::insert($genres);
    }
}
