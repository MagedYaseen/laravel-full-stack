<?php

namespace Database\Seeders;

use App\Models\PostStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $types = [
            'Pending',
            'Cancelled',
            'Published',
            'Postpond',
            'Reviewed'
        ];

        foreach ($types as $type) {
            PostStatus::create([
                'type' => $type
            ]);
        }

    }
}
