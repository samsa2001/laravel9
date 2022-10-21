<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 31; $i++) {
            $p = Post::find($i);
            $num = rand(1,5);
            $c1 = Tag::find($num);
            $num = rand(6,10);
            $c2 = Tag::find($num);
            if ($p){
                $p->tags()->sync([$c1->id,$c2->id]);
            }
        }
    }
}
