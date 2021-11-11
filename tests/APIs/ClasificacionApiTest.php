<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Clasificacion;

class ClasificacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_clasificacion()
    {
        $clasificacion = Clasificacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clasificacions', $clasificacion
        );

        $this->assertApiResponse($clasificacion);
    }

    /**
     * @test
     */
    public function test_read_clasificacion()
    {
        $clasificacion = Clasificacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/clasificacions/'.$clasificacion->id
        );

        $this->assertApiResponse($clasificacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_clasificacion()
    {
        $clasificacion = Clasificacion::factory()->create();
        $editedClasificacion = Clasificacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clasificacions/'.$clasificacion->id,
            $editedClasificacion
        );

        $this->assertApiResponse($editedClasificacion);
    }

    /**
     * @test
     */
    public function test_delete_clasificacion()
    {
        $clasificacion = Clasificacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/clasificacions/'.$clasificacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clasificacions/'.$clasificacion->id
        );

        $this->response->assertStatus(404);
    }
}
