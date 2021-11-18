<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Reserva;

class ReservaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_reserva()
    {
        $reserva = Reserva::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/reservas', $reserva
        );

        $this->assertApiResponse($reserva);
    }

    /**
     * @test
     */
    public function test_read_reserva()
    {
        $reserva = Reserva::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/reservas/'.$reserva->id
        );

        $this->assertApiResponse($reserva->toArray());
    }

    /**
     * @test
     */
    public function test_update_reserva()
    {
        $reserva = Reserva::factory()->create();
        $editedReserva = Reserva::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/reservas/'.$reserva->id,
            $editedReserva
        );

        $this->assertApiResponse($editedReserva);
    }

    /**
     * @test
     */
    public function test_delete_reserva()
    {
        $reserva = Reserva::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/reservas/'.$reserva->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/reservas/'.$reserva->id
        );

        $this->response->assertStatus(404);
    }
}
