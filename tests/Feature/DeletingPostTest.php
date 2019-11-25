<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeletingPostTest extends TestCase
{
    use RefreshDatabase;

    private function createNewCategory() {
        return factory(Category::class)->create();
    }

    private function createPost() {
        $file = UploadedFile::fake()->image('image.jpg');
        Storage::put('public/images/', $file);
        $data = [
            'image_location' => 'images/'.$file->hashName(),
            'description' => 'Une description',
            'category_id' => $this->createNewCategory()->id,
        ];
        Post::create($data);
    }
    /**
     * @test
     */
    public function a_guest_cannot_delete_a_post()
    {
        $post = factory(Post::class)->create();
        $response = $this->delete("/post/$post->id");
        $response->assertRedirect();
        $this->assertCount(1, Post::all());
    }

    /**
     */
    public function a_user_can_delete_a_post()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $post = factory(Post::class)->create();
        $response = $this->delete("/post/$post->id");
        $response->assertRedirect();
        $this->assertCount(0, Post::all());
    }

    /**
     * @test
     */
    public function the_image_is_deleted_when_the_post_is_deleted()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->createPost();
        $post = Post::first();
        $response = $this->delete("/post/$post->id");
        $response->assertRedirect();
        $this->assertCount(0, Post::all());
        Storage::disk('public')->assertMissing($post->image_location);
    }
}
