<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Regular user
        $user = User::create([
            'name'     => 'Regular User',
            'email'    => 'user@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        $user->articles()->createMany([
            ['title' => 'My First Article', 'body' => 'This is the body of my first article.'],
            ['title' => 'Second Thoughts',  'body' => 'Another article written by the user.'],
        ]);

        // Moderator (cannot create articles)
        User::create([
            'name'     => 'Moderator',
            'email'    => 'mod@example.com',
            'password' => Hash::make('password'),
            'role'     => 'moderator',
        ]);
    }
}
