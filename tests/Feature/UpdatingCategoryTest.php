<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdatingCategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function a_guest_cannot_update_a_category() {
        $category = factory(Category::class)->create();
        $data = ['name' => 'New Name'];
        $response = $this->putJson('/api/category/'.$category->id, $data);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function a_user_can_update_a_category() {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();
        $data = ['name' => 'New name'];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->putJson('/api/category/'.$category->id, $data);
        $response->assertOk();
        $this->assertEquals($data['name'], $category->fresh()->name);
        $response->assertJson(['data' => Category::first()->toArray()]);
    }

    /**
     * @test
     */
    public function an_invalid_name_is_rejected() {
        $category = factory(Category::class)->create();
        $data = ['name' => null];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->putJson('/api/category/'.$category->id, $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertNotEquals($data['name'], $category->fresh()->name);
    }

    /**
     * @test
     */
    public function an_duplicated_name_is_rejected() {
        $category = factory(Category::class)->create();
        $category2 = factory(Category::class)->create();
        $data = ['name' => $category->name];
        Passport::actingAs(factory(User::class)->create());
        $response = $this->putJson('/api/category/'.$category2->id, $data);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertNotEquals($data['name'], $category2);
    }

}
