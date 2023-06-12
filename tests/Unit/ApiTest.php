<?php

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_api_handles_valid_package_on_store(): void
    {
        $this->artisan('db:wipe');
        $this->artisan('migrate');
        $this->artisan('db:seed');

        $user = \App\Models\User::find(2);

        $json = '{
            "email": "test@trackr.com",
            "firstname": "kaas",
            "lastname": "baas",
            "streetname": "kaasweggetje",
            "housenumber": "12k",
            "zipcode": "1234ka",
            "city": "kaasdorp",
            "shop_id": "1"
        }';

        $response = $this->actingAs($user)
            ->postJson('api/packages/store', json_decode($json, true));

        $response->assertStatus(201)
            ->assertJson(json_decode($json, true));
    }

    public function test_api_handles_invalid_package_on_store(): void
    {
        $user = \App\Models\User::find(2);

        $json = '{
            "email": "",
            "firstname": "",
            "lastname": "baas",
            "streetname": "kaasweggetje",
            "housenumber": "12k",
            "zipcode": "1234ka",
            "city": "kaasdorp",
            "shop_id": "1"
        }';

        $response = $this->actingAs($user)
            ->postJson('api/packages/store', json_decode($json, true));

        $response->assertStatus(400);
    }

    public function test_api_handles_valid_package_on_update(): void
    {
        $user = \App\Models\User::find(2);

        $json = '{
            "status" : "on_the_way"
        }';

        $response = $this->actingAs($user)
            ->putJson('api/packages/update/3', json_decode($json, true));

        $response->assertStatus(200);
    }

    public function test_api_handles_invalid_package_on_update(): void
    {
        $user = \App\Models\User::find(2);

        $json = '{
            "status" : "naar_de_klote"
        }';

        $response = $this->actingAs($user)
            ->putJson('api/packages/update/3', json_decode($json, true));

        $response->assertStatus(400);
    }

    public function test_api_handles_unauthorized_on_update(): void
    {
        $user = \App\Models\User::find(3);

        $json = '{
            "status" : "on_the_way"
        }';

        $response = $this->actingAs($user)
            ->putJson('api/packages/update/3', json_decode($json, true));

        $response->assertStatus(403);
    }
}
