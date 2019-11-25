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

class UpdatingPostsTest extends TestCase
{
    use RefreshDatabase;
    private function createPostWithImage() {
        $file = UploadedFile::fake()->image('image.jpg');
        Storage::put('public/images/', $file);
        $data = [
            'image_location' => $file,
            'description' => 'Une description',
            'category_id' => $this->createNewCategory()->id,
        ];
        Post::create($data);
    }

    private function createPost() {
        return factory(Post::class)->create();
    }

    private function createNewCategory() {
        return factory(Category::class)->create();
    }

    private function updatePostData() {
        return [
            'image' => UploadedFile::fake()->image("newImage.jpeg"),
            'description' => 'New description',
            'category' => $this->createNewCategory()->id,
        ];
    }

    /**
     *
     * @test
     */
    public function a_guest_cannot_update_a_post() {
        $post = $this->createPost();
        $response = $this->put("/post/$post->id", $this->updatePostData());
        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function a_user_can_update_a_post() {
        Storage::fake('public');
        $post = $this->createPost();
        $user = factory(User::class)->create();
        $data = $this->updatePostData();

        $this->actingAs($user);
        $response = $this->put("/post/$post->id", $data);
        $response->assertRedirect();
        $this->assertEquals($data['description'], $post->fresh()->description);
        $this->assertEquals($data['category'], $post->fresh()->category_id);
        $this->assertEquals(Post::getPath($data['image']), $post->fresh()->image_location);
    }

    /**
     * @test
     */
    public function an_empty_description_is_rejected() {
        Storage::fake('public');

        $post = $this->createPost();
        $data = $this->updatePostData();
        $data['description'] = '';

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put("/post/$post->id", $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('description');
        $this->assertNotEquals($data['description'], $post->fresh()->description);
    }

    /**
     * @test
     *
     */
    public function an_empty_category_is_rejected() {
        Storage::fake('public');

        $post = $this->createPost();
        $data = $this->updatePostData();
        $data['category'] = '';

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put("/post/$post->id", $data);


        $response->assertRedirect();
        $response->assertSessionHasErrors('category');
        $this->assertNotEquals($data['category'], $post->fresh()->category_id);
    }

    /**
     * @test
     *
     */
    public function an_non_existent_category_is_rejected() {
        Storage::fake('public');

        $post = $this->createPost();
        $data = $this->updatePostData();
        $data['category'] = 5;

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put("/post/$post->id", $data);


        $response->assertRedirect();
        $response->assertSessionHasErrors('category');
        $this->assertNotEquals($data['category'], $post->fresh()->category_id);
    }

    /**
     * @test
     *
     */
    public function an_over_sized_image_is_rejected() {
        Storage::fake('public');
        $post = $this->createPost();
        $data = $this->updatePostData();
        $data['image'] = UploadedFile::fake()->image('image.jpg')->size(53250);
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put("/post/$post->id", $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('image');
        $this->assertNotEquals(Post::getPath($data['image']), $post->fresh()->image);
    }

    /**
     * @test
     *
     */
    public function a_image_is_stored_for_upload() {
        $data = $this->updatePostData();
        $post = $this->createPost();
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->put("/post/$post->id", $data);

        $response->assertRedirect();
        Storage::disk('public')->assertExists('images/'.$data['image']->hashName());
        $post = Post::first();
        $this->assertEquals($post->image_location, 'images/'.$data['image']->hashName());
    }

    /**
     * @test
     *
     */
    public function the_old_image_is_deleted_when_a_new_one_is_uploaded() {
        $this->createPostWithImage();
        $post = Post::first();
        $oldImage = $post->image_location;

        $data = $this->updatePostData();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->put("/post/$post->id", $data);

        $response->assertRedirect();
        $this->assertEquals(Post::getPath($data['image']), $post->fresh()->image_location);
        Storage::disk('public')->assertMissing($oldImage);
        Storage::disk('public')->assertExists(Post::getPath($data['image']));
    }

}
