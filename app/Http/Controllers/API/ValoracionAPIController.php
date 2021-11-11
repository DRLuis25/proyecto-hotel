<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateValoracionAPIRequest;
use App\Http\Requests\API\UpdateValoracionAPIRequest;
use App\Models\Valoracion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ValoracionController
 * @package App\Http\Controllers\API
 */

class ValoracionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Valoracion.
     * GET|HEAD /valoracions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Valoracion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $valoracions = $query->get();

         return $this->sendResponse(
             $valoracions->toArray(),
             __('messages.retrieved', ['model' => __('models/valoracions.plural')])
         );
    }

    /**
     * Store a newly created Valoracion in storage.
     * POST /valoracions
     *
     * @param CreateValoracionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateValoracionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Valoracion $valoracion */
        $valoracion = Valoracion::create($input);

        return $this->sendResponse(
             $valoracion->toArray(),
             __('messages.saved', ['model' => __('models/valoracions.singular')])
        );
    }

    /**
     * Display the specified Valoracion.
     * GET|HEAD /valoracions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Valoracion $valoracion */
        $valoracion = Valoracion::find($id);

        if (empty($valoracion)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/valoracions.singular')])
            );
        }

        return $this->sendResponse(
            $valoracion->toArray(),
            __('messages.retrieved', ['model' => __('models/valoracions.singular')])
        );
    }

    /**
     * Update the specified Valoracion in storage.
     * PUT/PATCH /valoracions/{id}
     *
     * @param int $id
     * @param UpdateValoracionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValoracionAPIRequest $request)
    {
        /** @var Valoracion $valoracion */
        $valoracion = Valoracion::find($id);

        if (empty($valoracion)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/valoracions.singular')])
           );
        }

        $valoracion->fill($request->all());
        $valoracion->save();

        return $this->sendResponse(
             $valoracion->toArray(),
             __('messages.updated', ['model' => __('models/valoracions.singular')])
        );
    }

    /**
     * Remove the specified Valoracion from storage.
     * DELETE /valoracions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Valoracion $valoracion */
        $valoracion = Valoracion::find($id);

        if (empty($valoracion)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/valoracions.singular')])
           );
        }

        $valoracion->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/valoracions.singular')])
         );
    }
}
