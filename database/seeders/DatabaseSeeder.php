<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories=Categorie::factory(5)->create();

        User::factory(10)->create()->each(function($user) use ($categories){
            Post::factory(rand(1,3))->create([
                'user_id' => $user->id,
                'categorie_id' => ($categories->random(1)->first())->id
            ]);
        });

    }
}
