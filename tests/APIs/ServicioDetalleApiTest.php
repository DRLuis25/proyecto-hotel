<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ServicioDetalle;

class ServicioDetalleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_servicio_detalle()
    {
        $servicioDetalle = ServicioDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/servicio_detalles', $servicioDetalle
        );

        $this->assertApiResponse($servicioDetalle);
    }

    /**
     * @test
     */
    public function test_read_servicio_detalle()
    {
        $servicioDetalle = ServicioDetalle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/servicio_detalles/'.$servicioDetalle->id
        );

        $this->assertApiResponse($servicioDetalle->toArray());
    }

    /**
     * @test
     */
    public function test_update_servicio_detalle()
    {
        $servicioDetalle = ServicioDetalle::factory()->create();
        $editedServicioDetalle = ServicioDetalle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/servicio_detalles/'.$servicioDetalle->id,
            $editedServicioDetalle
        );

        $this->assertApiResponse($editedServicioDetalle);
    }

    /**
     * @test
     */
    public function test_delete_servicio_detalle()
    {
        $servicioDetalle = ServicioDetalle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/servicio_detalles/'.$servicioDetalle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/servicio_detalles/'.$servicioDetalle->id
        );

        $this->response->assertStatus(404);
    }
}
