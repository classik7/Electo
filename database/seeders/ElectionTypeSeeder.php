<?php

namespace Database\Seeders;

use App\Models\ElectionType;
use App\Models\ElectionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ElectionTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [

            /*
            |--------------------------------------------------------------------------
            | EDUCATION
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Secondary School',
                'category' => 'Education',
                'icon' => 'academic-cap',
                'color' => 'blue',
                'description' => 'Secondary school student elections.',
                'setup_minutes' => 2,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'Head Boy',
                    'Head Girl',
                    'Senior Prefect',
                    'Sports Prefect',
                    'Labour Prefect',
                ],
                'is_featured' => true,
            ],

            [
                'name' => 'Polytechnic',
                'category' => 'Education',
                'icon' => 'building-library',
                'color' => 'cyan',
                'description' => 'Polytechnic elections.',
                'setup_minutes' => 3,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'General Secretary',
                    'Treasurer',
                    'PRO',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'University',
                'category' => 'Education',
                'icon' => 'building-library',
                'color' => 'indigo',
                'description' => 'University elections.',
                'setup_minutes' => 5,
                'difficulty' => 'Moderate',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'General Secretary',
                    'Financial Secretary',
                    'Treasurer',
                    'PRO',
                ],
                'is_featured' => true,
            ],

            [
                'name' => 'Faculty',
                'category' => 'Education',
                'icon' => 'building-office',
                'color' => 'purple',
                'description' => 'Faculty elections.',
                'setup_minutes' => 3,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'Secretary',
                    'Treasurer',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'Department',
                'category' => 'Education',
                'icon' => 'rectangle-group',
                'color' => 'emerald',
                'description' => 'Departmental elections.',
                'setup_minutes' => 2,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'Secretary',
                    'PRO',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'Student Union (SUG)',
                'category' => 'Education',
                'icon' => 'users',
                'color' => 'rose',
                'description' => 'Student Union Government elections.',
                'setup_minutes' => 6,
                'difficulty' => 'Advanced',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'General Secretary',
                    'Treasurer',
                    'Financial Secretary',
                    'Welfare Director',
                    'Sports Director',
                    'PRO',
                ],
                'is_featured' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | ORGANIZATIONS
            |--------------------------------------------------------------------------
            */

            [
                'name' => 'Association',
                'category' => 'Organization',
                'icon' => 'user-group',
                'color' => 'amber',
                'description' => 'Association executive elections.',
                'setup_minutes' => 3,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'Secretary',
                    'Treasurer',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'Cooperative',
                'category' => 'Organization',
                'icon' => 'users',
                'color' => 'green',
                'description' => 'Cooperative society elections.',
                'setup_minutes' => 4,
                'difficulty' => 'Moderate',
                'default_positions' => [
                    'Chairman',
                    'Vice Chairman',
                    'Secretary',
                    'Treasurer',
                    'Auditor',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'Religious Organization',
                'category' => 'Organization',
                'icon' => 'building-office-2',
                'color' => 'purple',
                'description' => 'Church, Mosque or Fellowship elections.',
                'setup_minutes' => 3,
                'difficulty' => 'Easy',
                'default_positions' => [
                    'President',
                    'Vice President',
                    'Secretary',
                    'Treasurer',
                    'Prayer Coordinator',
                ],
                'is_featured' => true,
            ],

            [
                'name' => 'Corporate',
                'category' => 'Organization',
                'icon' => 'briefcase',
                'color' => 'slate',
                'description' => 'Corporate board or staff elections.',
                'setup_minutes' => 5,
                'difficulty' => 'Advanced',
                'default_positions' => [
                    'Chairman',
                    'Vice Chairman',
                    'Board Secretary',
                    'Director',
                ],
                'is_featured' => true,
            ],

            [
                'name' => 'Community',
                'category' => 'Organization',
                'icon' => 'home',
                'color' => 'orange',
                'description' => 'Community leadership elections.',
                'setup_minutes' => 4,
                'difficulty' => 'Moderate',
                'default_positions' => [
                    'Chairman',
                    'Vice Chairman',
                    'Secretary',
                    'Youth Leader',
                    'Women Leader',
                ],
                'is_featured' => false,
            ],

            [
                'name' => 'Political',
                'category' => 'Organization',
                'icon' => 'flag',
                'color' => 'red',
                'description' => 'Political party elections.',
                'setup_minutes' => 8,
                'difficulty' => 'Advanced',
                'default_positions' => [
                    'Chairman',
                    'Deputy Chairman',
                    'Secretary',
                    'Treasurer',
                    'Organizing Secretary',
                    'PRO',
                ],
                'is_featured' => true,
            ],

        ];

        foreach ($types as $index => $type) {

    $category = ElectionCategory::where(
        'name',
        $type['category']
    )->first();

    if (!$category) {
        $this->command->warn("Category '{$type['category']}' not found.");
        continue;
    }

    ElectionType::updateOrCreate(

        [
            'slug' => Str::slug($type['name']),
        ],

        [
            'category_id' => $category->id,

            'name' => $type['name'],

            'slug' => Str::slug($type['name']),

            'icon' => $type['icon'],

            'color' => $type['color'],

            'description' => $type['description'],

            'setup_minutes' => $type['setup_minutes'],

            'difficulty' => $type['difficulty'],

            'default_positions' => $type['default_positions'],

            'is_featured' => $type['is_featured'],

            'status' => true,

            'approved' => true,

            'usage_count' => 0,

            'sort_order' => $index + 1,

        ]

    );
}
    }
}