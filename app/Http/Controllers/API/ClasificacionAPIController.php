<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClasificacionAPIRequest;
use App\Http\Requests\API\UpdateClasificacionAPIRequest;
use App\Models\Clasificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClasificacionController
 * @package App\Http\Controllers\API
 */

class ClasificacionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Clasificacion.
     * GET|HEAD /clasificacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Clasificacion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $clasificacions = $query->get();

         return $this->sendResponse(
             $clasificacions->toArray(),
             __('messages.retrieved', ['model' => __('models/clasificacions.plural')])
         );
    }

    /**
     * Store a newly created Clasificacion in storage.
     * POST /clasificacions
     *
     * @param CreateClasificacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClasificacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Clasificacion $clasificacion */
        $clasificacion = Clasificacion::create($input);

        return $this->sendResponse(
             $clasificacion->toArray(),
             __('messages.saved', ['model' => __('models/clasificacions.singular')])
        );
    }

    /**
     * Display the specified Clasificacion.
     * GET|HEAD /clasificacions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Clasificacion $clasificacion */
        $clasificacion = Clasificacion::find($id);

        if (empty($clasificacion)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clasificacions.singular')])
            );
        }

        return $this->sendResponse(
            $clasificacion->toArray(),
            __('messages.retrieved', ['model' => __('models/clasificacions.singular')])
        );
    }

    /**
     * Update the specified Clasificacion in storage.
     * PUT/PATCH /clasificacions/{id}
     *
     * @param int $id
     * @param UpdateClasificacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClasificacionAPIRequest $request)
    {
        /** @var Clasificacion $clasificacion */
        $clasificacion = Clasificacion::find($id);

        if (empty($clasificacion)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/clasificacions.singular')])
           );
        }

        $clasificacion->fill($request->all());
        $clasificacion->save();

        return $this->sendResponse(
             $clasificacion->toArray(),
             __('messages.updated', ['model' => __('models/clasificacions.singular')])
        );
    }

    /**
     * Remove the specified Clasificacion from storage.
     * DELETE /clasificacions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Clasificacion $clasificacion */
        $clasificacion = Clasificacion::find($id);

        if (empty($clasificacion)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/clasificacions.singular')])
           );
        }

        $clasificacion->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/clasificacions.singular')])
         );
    }
}
