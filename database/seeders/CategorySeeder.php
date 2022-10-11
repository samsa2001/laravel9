<?php

namespace Database\Seeders;

use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        for ($i = 1; $i < 21; $i++) {

            Category::create([
                'title' => 'Categoría'. $i,
                'url_clean' => 'categoria-'.$i
            ]);
        }
    }
}
