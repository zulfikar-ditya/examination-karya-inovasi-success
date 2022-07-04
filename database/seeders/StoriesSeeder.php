<?php

namespace Database\Seeders;

use App\Models\Stories;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=0; $i < 100; $i++) { 
            $title = $faker->text();
            $content = $faker->text(8000);

            Stories::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'image' => "",
                "content" => $content,
                "short_content" => Str::limit($content),
                "user_id" => random_int(1, 2),
                "category_id" => random_int(1, 5),
            ]);
        }
    }
}
