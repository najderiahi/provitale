<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ListingCategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function a_guest_cannot_have_the_list_of_categories() {
        $response = $this->getJson('/api/categories');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function a_user_can_have_the_list_of_categories() {
        factory(Category::class, 10)->create();
        Passport::actingAs(factory(User::class)->create());
        $response = $this->getJson('/api/categories');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links'
        ]);
        $response->assertJson(['data' => Category::all()->toArray()]);
    }

    /**
     * @test
     */
    public function categories_sent_are_paginated() {
        Passport::actingAs(factory(User::class)->create());
        factory(Post::class, 30)->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links'
        ]);
        $categories =Category::whereNotIn('id', Category::take(15)->get()->pluck('id'))->get();
        $response->assertJsonMissing(['data' => $categories->toArray()]);
    }
}
