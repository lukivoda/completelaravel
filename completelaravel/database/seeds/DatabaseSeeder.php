<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //disabling the foreign keys so that we can truncate the tables
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");

        //truncating tables before every seeding
        User::truncate();
        Category::truncate();
        Tag::truncate();
        Post::truncate();
        // accessing the DB facade to truncate the pivot table(we don't have model for the pivot tables)
        DB::table('post_tag')->truncate();

        $usersQuantity = 1;
        $categoriesQuantity = 6;
        $tagsQuantity = 10;
        $postsQuantity = 20;

        factory(User::class,$usersQuantity)->create();
        factory(Category::class,$categoriesQuantity)->create();
        factory(Tag::class,$tagsQuantity)->create();
        factory(Post::class,$postsQuantity)->create()->each(function($post){
            // we are getting collection of id's(random()function gets 1 to 5 records from the tags table and than we put all the id's from the records in an array with pluck method)
            $tags = Tag::all()->random(mt_rand(1,7))->pluck('id');
            //attaching the tags array with id's to post_tag pivot table
            $post->tags()->attach($tags);
        });

        //factory(Post::class,$postsQuantity)->create();


    }
}
