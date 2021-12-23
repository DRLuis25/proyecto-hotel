<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TipoProducto;

class TipoProductoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_producto()
    {
        $tipoProducto = TipoProducto::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_productos', $tipoProducto
        );

        $this->assertApiResponse($tipoProducto);
    }

    /**
     * @test
     */
    public function test_read_tipo_producto()
    {
        $tipoProducto = TipoProducto::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_productos/'.$tipoProducto->id
        );

        $this->assertApiResponse($tipoProducto->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_producto()
    {
        $tipoProducto = TipoProducto::factory()->create();
        $editedTipoProducto = TipoProducto::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_productos/'.$tipoProducto->id,
            $editedTipoProducto
        );

        $this->assertApiResponse($editedTipoProducto);
    }

    /**
     * @test
     */
    public function test_delete_tipo_producto()
    {
        $tipoProducto = TipoProducto::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_productos/'.$tipoProducto->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_productos/'.$tipoProducto->id
        );

        $this->response->assertStatus(404);
    }
}
