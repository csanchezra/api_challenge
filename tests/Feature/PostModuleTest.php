<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostModuleTest extends TestCase
{
    /**
     * @test
     */
    function test_correct_call()
    {

        $response = $this->get('/api/v1/posts/find_playlist/?city=Alaska,usa')
            ->assertJsonStructure([
                'status',
                'details',
                'tracks',
            ]);

        $response->assertStatus(200);
    }

    function test_incorrect_call_values()
    {

        $response = $this->get('/api/v1/posts/find_playlist/?city=Alaskausa')
            ->assertJsonStructure([
                'city',
            ]);

        $response->assertStatus(422);
    }


    function test_fail_call_city()
    {

        $response = $this->get('/api/v1/posts/find_playlist/?city=')
            ->assertJsonStructure([
                'city',
            ]);

        $response->assertStatus(422);
    }

    function test_fail_call()
    {

        $response = $this->get('/api/v1/posts/find_playlist/')
            ->assertJsonStructure([
                'city',
                'lat',
                'lon',
            ]);

        $response->assertStatus(422);
    }
}
