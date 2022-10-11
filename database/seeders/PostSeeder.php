<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $c = Category::inRandomOrder()->first();

            $title = Str::random(20);

            Post::create([
                'title' => $title,
                'url_clean' => Str::slug($title),
                'content' => "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae aperiam culpa veritatis quasi laudantium mollitia quidem est blanditiis ullam illum cupiditate suscipit, quia, itaque quaerat? Iure debitis laudantium aliquam maxime!</p>",
                'category_id' => $c->id,
                'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae ",
                'posted' => "yes"
            ]);
        }
    }
}
