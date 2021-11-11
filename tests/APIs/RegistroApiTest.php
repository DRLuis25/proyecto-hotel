<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Registro;

class RegistroApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_registro()
    {
        $registro = Registro::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/registros', $registro
        );

        $this->assertApiResponse($registro);
    }

    /**
     * @test
     */
    public function test_read_registro()
    {
        $registro = Registro::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/registros/'.$registro->id
        );

        $this->assertApiResponse($registro->toArray());
    }

    /**
     * @test
     */
    public function test_update_registro()
    {
        $registro = Registro::factory()->create();
        $editedRegistro = Registro::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/registros/'.$registro->id,
            $editedRegistro
        );

        $this->assertApiResponse($editedRegistro);
    }

    /**
     * @test
     */
    public function test_delete_registro()
    {
        $registro = Registro::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/registros/'.$registro->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/registros/'.$registro->id
        );

        $this->response->assertStatus(404);
    }
}
