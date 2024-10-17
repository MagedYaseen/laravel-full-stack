<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostStatus;
use App\Models\Reaction;
use App\Models\ReactionType;
use App\Models\Reply;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // users
        User::factory()->create([
            'name' => 'Maged Yaseen',
            'email' => 'magedyaseengroups@gmail.com',
            'photo' => 'https://assets.about.me/background/users/m/a/g/magedyaseen_1702270532_101.jpg',
            'roles' => 'admin',
            'password' => 'admin'
        ]);

        User::factory(100)->create();

        // Post Statuses
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


        // Reaction Types

        $types = [
            'Happy',
            'Sad',
            'Angry',
            'Confused',
            'Like',
            'Love'
        ];

        foreach ($types as $type) {
            ReactionType::create([
                'type' => $type
            ]);
        }


        // Posts
        Post::factory(350)->create();


        // Comments
        Comment::factory(1300)->create();

        // Replies
        Reply::factory(3020)->create();

        // Reactions
        Reaction::factory(3020)->create();

    }
}
