<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Criterio;

class CriterioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_criterio()
    {
        $criterio = Criterio::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/criterios', $criterio
        );

        $this->assertApiResponse($criterio);
    }

    /**
     * @test
     */
    public function test_read_criterio()
    {
        $criterio = Criterio::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/criterios/'.$criterio->id
        );

        $this->assertApiResponse($criterio->toArray());
    }

    /**
     * @test
     */
    public function test_update_criterio()
    {
        $criterio = Criterio::factory()->create();
        $editedCriterio = Criterio::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/criterios/'.$criterio->id,
            $editedCriterio
        );

        $this->assertApiResponse($editedCriterio);
    }

    /**
     * @test
     */
    public function test_delete_criterio()
    {
        $criterio = Criterio::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/criterios/'.$criterio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/criterios/'.$criterio->id
        );

        $this->response->assertStatus(404);
    }
}
