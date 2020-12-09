<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PayOrder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderCreate()
    {
        $response = $this->get('/order/create');
        $response->assertStatus(200);
        $response->assertViewIs('placetopay.order.create');
    }
    public function testOrderStore()
    {
        $response = $this->json('POST','order', 
        [
            'name' => 'Sally',
            'email'=>'jhonathan.ascenciog@gmail.com',
            'mobile_phone'=>'3204695757',
            'document'=>'1110000000',
            'address'=>'M r C 7 Palermo',
            'city'=>'Ibague',
            'state'=>'tolima',
            'last_name'=>'Ascencio',
            'document_type'=>'CC',
            'article_id'=>'1'
        ]);
            
        $response->assertStatus(302);
        
    }
    public function testOrderList()
    {
        $response = $this->get('/order');
        $response->assertStatus(200);
        $response->assertViewIs('placetopay.order.all');
    }
    public function testOrderShow()
    {
        $orders = PayOrder::inRandomOrder()->limit(10)->get();
        foreach($orders as $order){
            $response = $this->get("/order/$order->id");
            $response->assertStatus(200);
            $response->assertViewIs('placetopay.order.show');
        }
    }
}
