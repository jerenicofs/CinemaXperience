<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Media;
use App\Models\Reply;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medias =[
        [
            'title' => 'Alchemy Of Souls',
            'description' => 'A powerful sorceress in a blind woman\'s body encounters a man from a prestigious family, who wants her help to change his destiny.',
            'rating' => 8.7,
            'poster' => 'posts_images/aos.jpeg',
            'isPremium' => true,
            'released_date' => Carbon::parse('2022-06-18')->toDateString(),
            'genres' => ['korean-drama', 'action'],
            'source' => 'nlRw1CGbFU0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Because This Is My First Life',
            'description' => 'Se-hee, an overly practical man, decides to marry Ji-ho, an aspiring writer with a sweet temperament, just so that he can keep her as his tenant without inviting societal ire.',
            'rating' => 8.1,
            'poster' => 'posts_images/BTSMFSTL.jpg',
            'isPremium' => false,
            'released_date' => Carbon::parse('2017-10-09')->toDateString(),
            'genres' => ['melodrama'],
            'source' => 'agYjoFB909A',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Descendants of the Sun',
            'description' => 'A soldier belonging to the South Korean Special Forces falls in love with a beautiful surgeon. However, their relationship is short-lived as their professions keep them apart.',
            'rating' => 8.2,
            'poster' => 'posts_images/DOTS.jpg',
            'isPremium' => false,
            'released_date' => Carbon::parse('2016-02-24')->toDateString(),
            'genres' => ['korean-drama', 'action'],
            'source' => 'wkHjOTFv60g',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Extraordinary You',
            'description' => 'When a high-school girl finds that she is merely a character from a comic book whose destiny is decided by the writer, she decides to change the plot to suit her desires and find the love of her life.',
            'rating' => 7.8,
            'poster' => 'posts_images/EOY.jpg',
            'isPremium' => false,
            'released_date' => Carbon::parse('2019-10-02')->toDateString(),
            'genres' => ['korean-drama', 'romantic-comedy'],
            'source' => 'Fqj4UJfHW6w',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Our Beloved Summer',
            'description' => 'Years after filming a viral documentary in high school, two former lovers get pulled back in front of the camera and into each other\s lives.',
            'rating' => 8.2,
            'poster' => 'posts_images/obs.jpg',
            'isPremium' => false,
            'released_date' => Carbon::parse('2021-12-06')->toDateString(),
            'genres' => ['korean-drama', 'romantic-comedy'],
            'source' => 'wpW6aVWgvMc',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Queen of Tears',
            'description' => 'The queen of department stores and the prince of supermarkets weather a marital crisis, until love miraculously begins to bloom again.',
            'rating' => 8.3,
            'poster' => 'posts_images/Qot.jpg',
            'isPremium' => true,
            'released_date' => Carbon::parse('2024-03-09')->toDateString(),
            'genres' => ['korean-drama','thriller'],
            'source' => 'Gg2D8zrzlOA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'A Shop for Killers',
            'description' => 'A nephew who lost his parents and grew up in the hands of an uncle who runs a shopping mall faces a new truth after his uncle\'s sudden death.',
            'rating' => 8.1,
            'poster' => 'posts_images/shopforkiller.jpg',
            'isPremium' => true,
            'released_date' => Carbon::parse('2024-01-17')->toDateString(),
            'genres' => ['thriller', 'action'],
            'source' => '69nzLpyMSHw',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'Welcome to Samdalri',
            'description' => 'After suffering a fall from grace, a photographer returns to her hometown and bumps into her childhood friend, rekindling an unfinished romance.',
            'rating' => 8.0,
            'poster' => 'posts_images/WTSM.webp',
            'isPremium' => true,
            'released_date' => Carbon::parse('2023-12-02')->toDateString(),
            'genres' => ['korean-drama', 'melodrama'],
            'source' => 'aY8QmExZrlY',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => 'While You Were Sleeping',
            'description' => 'Three individuals, who have the power of precognition, help each other prevent disastrous incidents and take down a corrupt lawyer.',
            'rating' => 8.3,
            'poster' => 'posts_images/WYWS.jpg',
            'isPremium' => false,
            'released_date' => Carbon::parse('2017-09-27')->toDateString(),
            'genres' => ['korean-drama', 'romantic-comedy', 'action'],
            'source' => '8_rEZV3n3mk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]
        ];


        foreach ($medias as $media) {
            $mediaData = Media::create([
                'title' => $media['title'],
                'description' => $media['description'],
                'rating' => $media['rating'],
                'poster' => $media['poster'],
                'isPremium' => $media['isPremium'],
                'released_date' => $media['released_date'],
                'source' => $media['source'],
                'created_at' => $media['created_at'],
                'updated_at' => $media['updated_at'],
            ]);

            $genres = Genre::whereIn('genre_type', $media['genres'])->get();
            $mediaData->genre()->attach($genres);
        }

        foreach (Media::all() as $media) {
            Review::factory()->count(3)->create(['media_id' => $media->id]);
        }

        foreach (Review::all() as $review) {
            Reply::factory()->count(2)->create(['review_id' => $review->id]);
        }
    }
}
