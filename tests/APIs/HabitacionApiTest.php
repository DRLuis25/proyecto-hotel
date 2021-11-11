<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Habitacion;

class HabitacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_habitacion()
    {
        $habitacion = Habitacion::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/habitacions', $habitacion
        );

        $this->assertApiResponse($habitacion);
    }

    /**
     * @test
     */
    public function test_read_habitacion()
    {
        $habitacion = Habitacion::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/habitacions/'.$habitacion->id
        );

        $this->assertApiResponse($habitacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_habitacion()
    {
        $habitacion = Habitacion::factory()->create();
        $editedHabitacion = Habitacion::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/habitacions/'.$habitacion->id,
            $editedHabitacion
        );

        $this->assertApiResponse($editedHabitacion);
    }

    /**
     * @test
     */
    public function test_delete_habitacion()
    {
        $habitacion = Habitacion::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/habitacions/'.$habitacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/habitacions/'.$habitacion->id
        );

        $this->response->assertStatus(404);
    }
}
