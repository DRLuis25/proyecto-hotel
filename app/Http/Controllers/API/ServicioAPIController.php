<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServicioAPIRequest;
use App\Http\Requests\API\UpdateServicioAPIRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ServicioController
 * @package App\Http\Controllers\API
 */

class ServicioAPIController extends AppBaseController
{
    /**
     * Display a listing of the Servicio.
     * GET|HEAD /servicios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Servicio::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $servicios = $query->get();

         return $this->sendResponse(
             $servicios->toArray(),
             __('messages.retrieved', ['model' => __('models/servicios.plural')])
         );
    }

    /**
     * Store a newly created Servicio in storage.
     * POST /servicios
     *
     * @param CreateServicioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateServicioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Servicio $servicio */
        $servicio = Servicio::create($input);

        return $this->sendResponse(
             $servicio->toArray(),
             __('messages.saved', ['model' => __('models/servicios.singular')])
        );
    }

    /**
     * Display the specified Servicio.
     * GET|HEAD /servicios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Servicio $servicio */
        $servicio = Servicio::find($id);

        if (empty($servicio)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/servicios.singular')])
            );
        }

        return $this->sendResponse(
            $servicio->toArray(),
            __('messages.retrieved', ['model' => __('models/servicios.singular')])
        );
    }

    /**
     * Update the specified Servicio in storage.
     * PUT/PATCH /servicios/{id}
     *
     * @param int $id
     * @param UpdateServicioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServicioAPIRequest $request)
    {
        /** @var Servicio $servicio */
        $servicio = Servicio::find($id);

        if (empty($servicio)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/servicios.singular')])
           );
        }

        $servicio->fill($request->all());
        $servicio->save();

        return $this->sendResponse(
             $servicio->toArray(),
             __('messages.updated', ['model' => __('models/servicios.singular')])
        );
    }

    /**
     * Remove the specified Servicio from storage.
     * DELETE /servicios/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Servicio $servicio */
        $servicio = Servicio::find($id);

        if (empty($servicio)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/servicios.singular')])
           );
        }

        $servicio->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/servicios.singular')])
         );
    }
}
