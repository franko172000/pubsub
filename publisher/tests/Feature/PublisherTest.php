<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_publisher_published_topic(){
        $response = $this->post('api/publish/test-topic',[
            "title" => "test title",
            "excerpt" => "test excerpt",
            "description" => "test description"
        ]);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('message',$data);
        $this->assertEquals($data['message'], 'test-topic published successfully!');
        $response->assertStatus(200);
    }

    public function test_publisher_validaion_error(){
        $response = $this->post('api/publish/test-topic');
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('message',$data);
        $this->assertArrayHasKey('errors',$data);
        $this->assertArrayHasKey('title',$data['errors']);
        $this->assertArrayHasKey('excerpt',$data['errors']);
        $this->assertArrayHasKey('description', $data['errors']);
        $this->assertEquals($data['errors']['title'][0], 'Please provide news title');
        $this->assertEquals($data['errors']['excerpt'][0], 'Please provide news excerpt');
        $this->assertEquals($data['errors']['description'][0], 'Please provide news description');
        $response->assertStatus(422);
    }
}
