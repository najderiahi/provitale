<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewingPostsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function viewing_the_posts_page() {
        $this->withoutExceptionHandling();
        $categories = factory(Category::class, 3)->create();
        $postsForCategory1 = collect([
            Post::create(['description' => 'First Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fourth Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Sixth Description', 'category_id' => 1, 'image_location' => 'fake/location'])
        ]);

        $postsForCategory2 = collect([
            Post::create(['description' => 'Third Description', 'category_id' => 2, 'image_location' => 'fake/location']),
        ]);
        $postsForCategory3 = collect([
            Post::create(['description' => 'Second Description', 'category_id' => 3, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fifth Description', 'category_id' => 3, 'image_location' => 'fake/location']),
        ]);
        $response = $this->get('/');

        $response->assertOk();
        $this->assertCount(3, $response->data('posts'));
        $postsForCategory1->assertEquals($response->data('posts')[0]->posts);
        $postsForCategory2->assertEquals($response->data('posts')[1]->posts);
        $postsForCategory3->assertEquals($response->data('posts')[2]->posts);
    }

    /**
     * @test
     */
    public function a_limited_number_of_categories_is_sent() {
        $categories = factory(Category::class, 100)->create();
        $postsForCategory1 = collect([
            Post::create(['description' => 'First Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fourth Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Sixth Description', 'category_id' => 1, 'image_location' => 'fake/location'])
        ]);

        $postsForCategory2 = collect([
            Post::create(['description' => 'Third Description', 'category_id' => 2, 'image_location' => 'fake/location']),
        ]);
        $postsForCategory3 = collect([
            Post::create(['description' => 'Second Description', 'category_id' => 3, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fifth Description', 'category_id' => 3, 'image_location' => 'fake/location']),
        ]);
        $response = $this->get('/');
        $this->assertCount(15, $response->data('posts'));
        $postsForCategory1->assertEquals($response->data('posts')[0]->posts);
        $postsForCategory2->assertEquals($response->data('posts')[1]->posts);
        $postsForCategory3->assertEquals($response->data('posts')[2]->posts);
    }

    /**
     * @test
     */
    public function a_limited_number_of_posts_per_category_is_sent() {
        $categories = factory(Category::class)->create();
        $postsForCategory1 = factory(Post::class, 100)->create(['category_id' => 1]);

        $response = $this->get('/');
        $this->assertCount(1, $response->data('posts'));
        $this->assertCount(8, $response->data('posts')[0]->posts);
        $postsForCategory1->assertContains($response->data('posts')[0]->posts);
    }

    /**
     * @test
     */
    public function viewing_posts_for_a_certain_category() {
        $categories = factory(Category::class, 3)->create();
        $postsForCategory1 = collect([
            Post::create(['description' => 'First Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fourth Description', 'category_id' => 1, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Sixth Description', 'category_id' => 1, 'image_location' => 'fake/location'])
        ]);

        $postsForCategory2 = collect([
            Post::create(['description' => 'Third Description', 'category_id' => 2, 'image_location' => 'fake/location']),
        ]);
        $postsForCategory3 = collect([
            Post::create(['description' => 'Second Description', 'category_id' => 3, 'image_location' => 'fake/location']),
            Post::create(['description' => 'Fifth Description', 'category_id' => 3, 'image_location' => 'fake/location']),
        ]);

        $response = $this->get('/category/1/posts');
        $this->assertCount(3, $response->data('posts'));
        $postsForCategory1->assertContains($response->data('posts'));
    }

    /**
     *
     * @test
     */
    public function posts_are_paginated() {
        $categories = factory(Category::class, 3)->create();
        $postsForCategory1 = factory(Post::class, 100)->create(['category_id' => 1]);

        $response = $this->get('/category/1/posts');
        $this->assertCount(15, $response->data('posts'));
    }

    /**
     * @test
     */
    public function posts_are_ordered_in_chronological_order() {
        $categories = factory(Category::class, 1)->create();
        $postsForCategory1 = collect([
            Post::create(['description' => 'First Description', 'category_id' => 1, 'image_location' => 'fake/location', 'created_at' => now()->subDays(3)]),
            Post::create(['description' => 'Sixth Description', 'category_id' => 1, 'image_location' => 'fake/location', 'created_at' => now()]),
        ]);
        $response = $this->get('/category/1/posts');
        $data = $response->data('posts');
        $this->assertTrue($postsForCategory1[0]->is($data[1]));
        $this->assertTrue($postsForCategory1[1]->is($data[0]));
    }
}
