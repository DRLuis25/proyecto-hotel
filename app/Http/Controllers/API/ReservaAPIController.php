<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReservaAPIRequest;
use App\Http\Requests\API\UpdateReservaAPIRequest;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReservaController
 * @package App\Http\Controllers\API
 */

class ReservaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Reserva.
     * GET|HEAD /reservas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Reserva::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $reservas = $query->get();

         return $this->sendResponse(
             $reservas->toArray(),
             __('messages.retrieved', ['model' => __('models/reservas.plural')])
         );
    }

    /**
     * Store a newly created Reserva in storage.
     * POST /reservas
     *
     * @param CreateReservaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReservaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Reserva $reserva */
        $reserva = Reserva::create($input);

        return $this->sendResponse(
             $reserva->toArray(),
             __('messages.saved', ['model' => __('models/reservas.singular')])
        );
    }

    /**
     * Display the specified Reserva.
     * GET|HEAD /reservas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Reserva $reserva */
        $reserva = Reserva::find($id);

        if (empty($reserva)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reservas.singular')])
            );
        }

        return $this->sendResponse(
            $reserva->toArray(),
            __('messages.retrieved', ['model' => __('models/reservas.singular')])
        );
    }

    /**
     * Update the specified Reserva in storage.
     * PUT/PATCH /reservas/{id}
     *
     * @param int $id
     * @param UpdateReservaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservaAPIRequest $request)
    {
        /** @var Reserva $reserva */
        $reserva = Reserva::find($id);

        if (empty($reserva)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/reservas.singular')])
           );
        }

        $reserva->fill($request->all());
        $reserva->save();

        return $this->sendResponse(
             $reserva->toArray(),
             __('messages.updated', ['model' => __('models/reservas.singular')])
        );
    }

    /**
     * Remove the specified Reserva from storage.
     * DELETE /reservas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Reserva $reserva */
        $reserva = Reserva::find($id);

        if (empty($reserva)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/reservas.singular')])
           );
        }

        $reserva->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/reservas.singular')])
         );
    }
}
