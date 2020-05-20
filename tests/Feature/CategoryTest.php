<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function category()
    {
        $response = $this->get('/api/faq/questions', [
            'category_id' => -1, 
            'current_page' => 1
        ]);
        // $this->json('post', '/api/finish_order',
        //     ["order_id" => $order->order_id]);
                       
        $response->assertStatus(200);
    }
}
