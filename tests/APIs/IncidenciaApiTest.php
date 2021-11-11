<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Incidencia;

class IncidenciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_incidencia()
    {
        $incidencia = Incidencia::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/incidencias', $incidencia
        );

        $this->assertApiResponse($incidencia);
    }

    /**
     * @test
     */
    public function test_read_incidencia()
    {
        $incidencia = Incidencia::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/incidencias/'.$incidencia->id
        );

        $this->assertApiResponse($incidencia->toArray());
    }

    /**
     * @test
     */
    public function test_update_incidencia()
    {
        $incidencia = Incidencia::factory()->create();
        $editedIncidencia = Incidencia::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/incidencias/'.$incidencia->id,
            $editedIncidencia
        );

        $this->assertApiResponse($editedIncidencia);
    }

    /**
     * @test
     */
    public function test_delete_incidencia()
    {
        $incidencia = Incidencia::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/incidencias/'.$incidencia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/incidencias/'.$incidencia->id
        );

        $this->response->assertStatus(404);
    }
}
