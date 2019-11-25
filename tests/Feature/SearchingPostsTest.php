<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchingPostsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function searching_by_category_slug_gives_only_posts_from_that_category()
    {
        $this->withoutExceptionHandling();
        $category = Category::create(['name' => 'First']);
        $category2 = Category::create(['name' => 'Second']);
        $posts = collect([
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 2]),
            factory(Post::class)->create(['category_id' => 2]),
            factory(Post::class)->create(['category_id' => 2]),
        ]);

        $response = $this->get('/search?category[]='.$category->name);
        $this->assertCount(3, $response->data('posts'));
        $dbPosts = Post::where('category_id', 1)->get();
        $dbPosts->assertEquals($response->data('posts'));
    }

    /**
     * @test
     */
    public function searching_by_category_slug_with_a_invalid_category_returns_nothing() {
        $category = Category::create(['name' => 'First']);
        $category = Category::create(['name' => 'Second']);
        $posts = collect([
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 1]),
            factory(Post::class)->create(['category_id' => 2]),
            factory(Post::class)->create(['category_id' => 2]),
            factory(Post::class)->create(['category_id' => 2]),
        ]);

        $response = $this->get('/search?category[]=Invalid');
        $this->assertCount(0, $response->data('posts'));
    }

    /**
     * @test
     */
    public function searching_by_description_works() {
        $post1 = factory(Post::class)->create(['description' => 'Je suis une description']);
        $post2 = factory(Post::class)->create(['description' => 'Vide']);
        $post3 = factory(Post::class)->create(['description' => 'Introuvable']);

        $response = $this->get('/search?query=Je+suis');
        $this->assertCount(1, $response->data('posts'));
        $this->assertTrue($post1->is($response->data('posts')[0]));
    }

    /**
     * @test
     */
    public function searching_by_invalid_description_fails() {
        $post1 = factory(Post::class)->create(['description' => 'Description']);
        $post2 = factory(Post::class)->create(['description' => 'Vide']);
        $post3 = factory(Post::class)->create(['description' => 'Introuvable']);

        $response = $this->get('/search?query=Je');
        $this->assertCount(0, $response->data('posts'));
    }

    /**
     * @test
     */
    public function order_by_recent_works() {
        $oldest = factory(Post::class)->create();
        $latest = factory(Post::class)->create(['created_at' => now()->addDays(2)]);
        $response = $this->get('/search?sort=latest');

        $this->assertCount(2, $response->data('posts'));
        $this->assertTrue($response->data('posts')[0]->created_at->gt($response->data('posts')[1]->created_at));
    }

    /**
     * @test
     */
    public function order_by_older_works() {
        $oldest = factory(Post::class)->create();
        $latest = factory(Post::class)->create(['created_at' => now()->addDays(2)]);
        $response = $this->get('/search?sort=oldest');

        $this->assertCount(2, $response->data('posts'));
        $this->assertTrue($response->data('posts')[0]->created_at->lt($response->data('posts')[1]->created_at));
    }
}
