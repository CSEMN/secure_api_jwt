<?php

namespace Tests\Feature;

use App\Http\Controllers\JWTController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list_all_products(){
        $response = $this->getJson('/api/products');
        $response->assertStatus(200);
    }

    public function test_view_one_product(){
        $response = $this->withHeader('Authorization',$this->get_token())->getJson('/api/products/1');
        $response->assertStatus(200);
    }

    private function  get_token(){
        $user = User::all()->first();
        auth()->login($user);
        return 'bearer '. JWTAuth::fromUser($user);
    }
}
