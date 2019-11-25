<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ListingPostsTest extends TestCase
{

    use RefreshDatabase;
    /**
     *
     * @test
     */
    public function a_guest_cannot_have_a_list_of_posts() {
        $response = $this->getJson('/api/posts');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function a_user_can_have_a_list_of_posts() {
        Passport::actingAs(factory(User::class)->create());
        factory(Post::class, 10)->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links'
        ]);
        $response->assertJson(['data' => Post::with('category')->get()->toArray()]);
    }

    /**
     * @test
     */
    public function posts_sent_are_paginated() {
        Passport::actingAs(factory(User::class)->create());
        factory(Post::class, 30)->create();
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links'
        ]);
        $posts = Post::with('category')->whereNotIn('id', Post::take(15)->get()->pluck('id'))->get();
        $response->assertJsonMissing(['data' => $posts->toArray()]);
    }
}
