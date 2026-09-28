<?php

namespace Database\Seeders;

use App\Models\ElectionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ElectionCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Education',
                'icon' => 'academic-cap',
                'color' => 'blue',
                'description' => 'Schools, colleges, universities and academic institutions.',
            ],

            [
                'name' => 'Organization',
                'icon' => 'building-office',
                'color' => 'emerald',
                'description' => 'Associations, NGOs, cooperatives and companies.',
            ],

            [
                'name' => 'Government',
                'icon' => 'building-library',
                'color' => 'red',
                'description' => 'Government institutions and agencies.',
            ],

            [
                'name' => 'Community',
                'icon' => 'home-modern',
                'color' => 'orange',
                'description' => 'Communities and local leadership elections.',
            ],

            [
                'name' => 'Religious',
                'icon' => 'building-office-2',
                'color' => 'purple',
                'description' => 'Churches, mosques and religious organizations.',
            ],

            [
                'name' => 'Professional',
                'icon' => 'briefcase',
                'color' => 'cyan',
                'description' => 'Professional bodies and institutes.',
            ],

        ];

        foreach ($categories as $index => $category) {

            ElectionCategory::updateOrCreate(

                [
                    'slug' => Str::slug($category['name']),
                ],

                [

                    'name' => $category['name'],

                    'slug' => Str::slug($category['name']),

                    'icon' => $category['icon'],

                    'color' => $category['color'],

                    'description' => $category['description'],

                    'status' => true,

                    'sort_order' => $index + 1,

                ]

            );

        }
    }
}