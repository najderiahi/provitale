<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreatingCategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_guest_cannot_create_a_category() {
        $data = ['name' => 'Category name'];
        $response = $this->postJson('/api/categories', $data);
        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function a_user_can_create_a_category() {
        $data = ['name' => 'Category name'];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->postJson('/api/categories', $data);
        $response->assertRedirect();
        $this->assertCount(1, Category::all());
    }

    /**
     * @test
     */
    public function a_category_name_is_required() {
        $data = [];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->postJson('/api/categories', $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertCount(0, Category::all());
    }

    /**
     * @test
     */
    public function a_category_name_is_unique() {
        $category = factory(Category::class)->create();
        $data = ['name' => $category->name];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->postJson('/api/categories', $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertNotEquals(1, Category::all());
    }
}
