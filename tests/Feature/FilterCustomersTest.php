<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterCustomersTest extends TestCase
{
    function test_can_apply_filter_by_code()
    {

        $response = $this->json('GET','/api/customers?code=+212');
        $response->assertStatus(200);
        $this->assertEquals($response['data']['data'][0]['code'],'212');
        $response->assertJsonStructure(['status','data']);
    }

    function test_can_apply_filter_by_state()
    {

        $response = $this->json('GET','/api/customers?state=1');
        $response->assertStatus(200);
        $this->assertEquals($response['data']['data'][0]['is_valid'],'1');
        $response->assertJsonStructure(['status','data']);
    }

    function test_can_not_filter_with_invalid_state_input()
    {
        $response = $this->json('GET','/api/customers?state=test');
        $response->assertStatus(422);
        $response->assertJson(['status'=>"Invalid inputs!"]);
    }


}
