<?php

namespace Tests\Feature;

use App\Category;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeletingCategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_guest_cannot_delete_a_category() {
        $category = factory(Category::class)->create();
        $response = $this->deleteJson('/api/category/'.$category->id);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function a_user_can_delete_a_category() {
        $this->withoutExceptionHandling();
        $category = factory(Category::class)->create();

        Passport::actingAs(factory(User::class)->create());
        $response = $this->deleteJson('/api/category/'.$category->id);
        $response->assertStatus(Response::HTTP_ACCEPTED);
        $this->assertCount(0, Category::all());
    }

}
