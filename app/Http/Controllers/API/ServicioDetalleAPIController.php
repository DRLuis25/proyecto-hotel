<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServicioDetalleAPIRequest;
use App\Http\Requests\API\UpdateServicioDetalleAPIRequest;
use App\Models\ServicioDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ServicioDetalleController
 * @package App\Http\Controllers\API
 */

class ServicioDetalleAPIController extends AppBaseController
{
    /**
     * Display a listing of the ServicioDetalle.
     * GET|HEAD /servicioDetalles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ServicioDetalle::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $servicioDetalles = $query->get();

         return $this->sendResponse(
             $servicioDetalles->toArray(),
             __('messages.retrieved', ['model' => __('models/servicioDetalles.plural')])
         );
    }

    /**
     * Store a newly created ServicioDetalle in storage.
     * POST /servicioDetalles
     *
     * @param CreateServicioDetalleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateServicioDetalleAPIRequest $request)
    {
        $input = $request->all();

        /** @var ServicioDetalle $servicioDetalle */
        $servicioDetalle = ServicioDetalle::create($input);

        return $this->sendResponse(
             $servicioDetalle->toArray(),
             __('messages.saved', ['model' => __('models/servicioDetalles.singular')])
        );
    }

    /**
     * Display the specified ServicioDetalle.
     * GET|HEAD /servicioDetalles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ServicioDetalle $servicioDetalle */
        $servicioDetalle = ServicioDetalle::find($id);

        if (empty($servicioDetalle)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/servicioDetalles.singular')])
            );
        }

        return $this->sendResponse(
            $servicioDetalle->toArray(),
            __('messages.retrieved', ['model' => __('models/servicioDetalles.singular')])
        );
    }

    /**
     * Update the specified ServicioDetalle in storage.
     * PUT/PATCH /servicioDetalles/{id}
     *
     * @param int $id
     * @param UpdateServicioDetalleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServicioDetalleAPIRequest $request)
    {
        /** @var ServicioDetalle $servicioDetalle */
        $servicioDetalle = ServicioDetalle::find($id);

        if (empty($servicioDetalle)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/servicioDetalles.singular')])
           );
        }

        $servicioDetalle->fill($request->all());
        $servicioDetalle->save();

        return $this->sendResponse(
             $servicioDetalle->toArray(),
             __('messages.updated', ['model' => __('models/servicioDetalles.singular')])
        );
    }

    /**
     * Remove the specified ServicioDetalle from storage.
     * DELETE /servicioDetalles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ServicioDetalle $servicioDetalle */
        $servicioDetalle = ServicioDetalle::find($id);

        if (empty($servicioDetalle)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/servicioDetalles.singular')])
           );
        }

        $servicioDetalle->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/servicioDetalles.singular')])
         );
    }
}
