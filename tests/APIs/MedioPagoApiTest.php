<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MedioPago;

class MedioPagoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medio_pago()
    {
        $medioPago = MedioPago::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/medio_pagos', $medioPago
        );

        $this->assertApiResponse($medioPago);
    }

    /**
     * @test
     */
    public function test_read_medio_pago()
    {
        $medioPago = MedioPago::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/medio_pagos/'.$medioPago->id
        );

        $this->assertApiResponse($medioPago->toArray());
    }

    /**
     * @test
     */
    public function test_update_medio_pago()
    {
        $medioPago = MedioPago::factory()->create();
        $editedMedioPago = MedioPago::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/medio_pagos/'.$medioPago->id,
            $editedMedioPago
        );

        $this->assertApiResponse($editedMedioPago);
    }

    /**
     * @test
     */
    public function test_delete_medio_pago()
    {
        $medioPago = MedioPago::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/medio_pagos/'.$medioPago->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/medio_pagos/'.$medioPago->id
        );

        $this->response->assertStatus(404);
    }
}
