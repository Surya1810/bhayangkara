<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Category::create([
            'name' => 'Teknologi',
            'slug' =>  Str::slug('Teknologi')
        ]);
        $admin = Category::create([
            'name' => 'Nasional',
            'slug' =>  Str::slug('Nasional')
        ]);
        $admin = Category::create([
            'name' => 'Internasional',
            'slug' =>  Str::slug('Internasional')
        ]);
        $admin = Category::create([
            'name' => 'Politik',
            'slug' =>  Str::slug('Politik')
        ]);
        $admin = Category::create([
            'name' => 'Ekonomi',
            'slug' =>  Str::slug('Ekonomi')
        ]);
        $admin = Category::create([
            'name' => 'Olahraga',
            'slug' =>  Str::slug('Olahraga')
        ]);
        $admin = Category::create([
            'name' => 'Kegiatan Polisi',
            'slug' =>  Str::slug('Kegiatan Polisi')
        ]);
        $admin = Category::create([
            'name' => 'Lainnya',
            'slug' =>  Str::slug('Lainnya')
        ]);
    }
}
