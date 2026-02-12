<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create regular users
        $users = User::factory(5)->create();

        // Create posts for each user
        $users->each(function ($user) {
            Post::factory(3)
                ->published()
                ->has(Comment::factory(2))
                ->create(['user_id' => $user->id]);

            Post::factory(1)
                ->draft()
                ->create(['user_id' => $user->id]);
        });
    }
}
