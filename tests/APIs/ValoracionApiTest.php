<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Valoracion;

class ValoracionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_valoracion()
    {
        $valoracion = Valoracion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/valoracions', $valoracion
        );

        $this->assertApiResponse($valoracion);
    }

    /**
     * @test
     */
    public function test_read_valoracion()
    {
        $valoracion = Valoracion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/valoracions/'.$valoracion->id
        );

        $this->assertApiResponse($valoracion->toArray());
    }

    /**
     * @test
     */
    public function test_update_valoracion()
    {
        $valoracion = Valoracion::factory()->create();
        $editedValoracion = Valoracion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/valoracions/'.$valoracion->id,
            $editedValoracion
        );

        $this->assertApiResponse($editedValoracion);
    }

    /**
     * @test
     */
    public function test_delete_valoracion()
    {
        $valoracion = Valoracion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/valoracions/'.$valoracion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/valoracions/'.$valoracion->id
        );

        $this->response->assertStatus(404);
    }
}
