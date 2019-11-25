<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreatingPostsTest extends TestCase
{
    use RefreshDatabase;

    private function createNewCategory() {
        $category = Category::create(['name' => 'Une nouvelle catégorie']);
        return $category;
    }

    private function postData() {
        $file = UploadedFile::fake()->image('image.jpg');
        return [
            'image' => $file,
            'description' => 'Une description',
            'category' => $this->createNewCategory()->id,
        ];
    }

    /**
     * @test
     */
    public function a_guest_cannot_create_a_new_post() {
        Storage::fake('public');
        $response = $this->post('/posts', $this->postData());
        $response->assertRedirect();
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */
    public function a_user_can_create_posts() {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->post('/posts', $this->postData());
        $response->assertRedirect();
        $this->assertCount(1, Post::all());
    }

    /**
     * @test
     */
    public function a_description_is_required() {
        Storage::fake('public');
        $data = $this->postData();
        unset($data['description']);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('description');
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */
    public function a_category_is_required() {
        Storage::fake('public');
        $data = $this->postData();
        unset($data['category']);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('category');
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */
    public function an_invalid_category_id_are_rejected() {
        Storage::fake('public');
        $data = $this->postData();
        $data['category'] = "Invalid";
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('category');
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */
    public function an_image_is_required() {
        Storage::fake('public');
        $data = $this->postData();
        unset($data['image']);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('image');
        $this->assertCount(0, Post::all());
    }


    /**
     * @test
     */
    public function an_image_is_cannot_be_more_than_52M() {
        Storage::fake('public');
        $data = $this->postData();
        $data['image'] = UploadedFile::fake()->image('image.jpg')->size(53250);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('image');
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */

    public function an_image_is_uploaded_each_time_post_is_posted() {
        $data = $this->postData();
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->post('/posts', $data);

        $response->assertRedirect();
        $this->assertCount(1, Post::all());
        Storage::disk('public')->assertExists('images/'.$data['image']->hashName());
        $post = Post::first();
        $this->assertEquals($post->image_location, 'images/'.$data['image']->hashName());
    }

}
