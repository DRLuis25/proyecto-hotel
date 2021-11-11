<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateIncidenciaAPIRequest;
use App\Http\Requests\API\UpdateIncidenciaAPIRequest;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IncidenciaController
 * @package App\Http\Controllers\API
 */

class IncidenciaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Incidencia.
     * GET|HEAD /incidencias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Incidencia::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $incidencias = $query->get();

         return $this->sendResponse(
             $incidencias->toArray(),
             __('messages.retrieved', ['model' => __('models/incidencias.plural')])
         );
    }

    /**
     * Store a newly created Incidencia in storage.
     * POST /incidencias
     *
     * @param CreateIncidenciaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateIncidenciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Incidencia $incidencia */
        $incidencia = Incidencia::create($input);

        return $this->sendResponse(
             $incidencia->toArray(),
             __('messages.saved', ['model' => __('models/incidencias.singular')])
        );
    }

    /**
     * Display the specified Incidencia.
     * GET|HEAD /incidencias/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Incidencia $incidencia */
        $incidencia = Incidencia::find($id);

        if (empty($incidencia)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/incidencias.singular')])
            );
        }

        return $this->sendResponse(
            $incidencia->toArray(),
            __('messages.retrieved', ['model' => __('models/incidencias.singular')])
        );
    }

    /**
     * Update the specified Incidencia in storage.
     * PUT/PATCH /incidencias/{id}
     *
     * @param int $id
     * @param UpdateIncidenciaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateIncidenciaAPIRequest $request)
    {
        /** @var Incidencia $incidencia */
        $incidencia = Incidencia::find($id);

        if (empty($incidencia)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/incidencias.singular')])
           );
        }

        $incidencia->fill($request->all());
        $incidencia->save();

        return $this->sendResponse(
             $incidencia->toArray(),
             __('messages.updated', ['model' => __('models/incidencias.singular')])
        );
    }

    /**
     * Remove the specified Incidencia from storage.
     * DELETE /incidencias/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Incidencia $incidencia */
        $incidencia = Incidencia::find($id);

        if (empty($incidencia)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/incidencias.singular')])
           );
        }

        $incidencia->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/incidencias.singular')])
         );
    }
}
