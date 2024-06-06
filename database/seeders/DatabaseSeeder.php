<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            ['name' => 'Test User 1', 'email' => 'test1@example.com', 'password' => 'asdASD123'],
            ['name' => 'Test User 2', 'email' => 'test2@example.com', 'password' => 'asdASD123'],
            ['name' => 'Test User 3', 'email' => 'test3@example.com', 'password' => 'asdASD123'],
            ['name' => 'Test User 4', 'email' => 'test4@example.com', 'password' => 'asdASD123'],
            ['name' => 'Test User 5', 'email' => 'test5@example.com', 'password' => 'asdASD123'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
        

        $categories = [
            ['slug' => 'category_1', 'user_readable_name' => 'First Category'],
            ['slug' => 'category_2', 'user_readable_name' => 'Second Category'],
            ['slug' => 'category_3', 'user_readable_name' => 'Third Category'],
            ['slug' => 'category_4', 'user_readable_name' => 'Fourth Category'],
            ['slug' => 'category_5', 'user_readable_name' => 'Fifth Category'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        $posts = [
            ['title' => 'First Post', 'content' => 'Content for the first post', 'user_id' => User::first()->id],
            ['title' => 'Second Post', 'content' => 'Content for the second post', 'user_id' => User::first()->id],
            ['title' => 'Third Post', 'content' => 'Content for the third post', 'user_id' => User::first()->id],
            ['title' => 'Fourth Post', 'content' => 'Content for the fourth post', 'user_id' => User::first()->id],
            ['title' => 'Fifth Post', 'content' => 'Content for the fifth post', 'user_id' => User::first()->id],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['title' => $post['title']], $post);
        }

        $postCategories = [
            ['post_id' => Post::first()->id, 'category_id' => Category::first()->id],
            ['post_id' => Post::skip(1)->first()->id, 'category_id' => Category::skip(1)->first()->id],
            ['post_id' => Post::skip(2)->first()->id, 'category_id' => Category::skip(2)->first()->id],
            ['post_id' => Post::skip(3)->first()->id, 'category_id' => Category::skip(3)->first()->id],
            ['post_id' => Post::skip(4)->first()->id, 'category_id' => Category::skip(4)->first()->id],
        ];

        foreach ($postCategories as $postCategory) {
            PostCategory::updateOrCreate(
                ['post_id' => $postCategory['post_id'], 'category_id' => $postCategory['category_id']],
                $postCategory
            );
        }
    }
}
