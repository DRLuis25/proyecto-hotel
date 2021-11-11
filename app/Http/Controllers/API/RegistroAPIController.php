<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRegistroAPIRequest;
use App\Http\Requests\API\UpdateRegistroAPIRequest;
use App\Models\Registro;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RegistroController
 * @package App\Http\Controllers\API
 */

class RegistroAPIController extends AppBaseController
{
    /**
     * Display a listing of the Registro.
     * GET|HEAD /registros
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Registro::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $registros = $query->get();

         return $this->sendResponse(
             $registros->toArray(),
             __('messages.retrieved', ['model' => __('models/registros.plural')])
         );
    }

    /**
     * Store a newly created Registro in storage.
     * POST /registros
     *
     * @param CreateRegistroAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRegistroAPIRequest $request)
    {
        $input = $request->all();

        /** @var Registro $registro */
        $registro = Registro::create($input);

        return $this->sendResponse(
             $registro->toArray(),
             __('messages.saved', ['model' => __('models/registros.singular')])
        );
    }

    /**
     * Display the specified Registro.
     * GET|HEAD /registros/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Registro $registro */
        $registro = Registro::find($id);

        if (empty($registro)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/registros.singular')])
            );
        }

        return $this->sendResponse(
            $registro->toArray(),
            __('messages.retrieved', ['model' => __('models/registros.singular')])
        );
    }

    /**
     * Update the specified Registro in storage.
     * PUT/PATCH /registros/{id}
     *
     * @param int $id
     * @param UpdateRegistroAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRegistroAPIRequest $request)
    {
        /** @var Registro $registro */
        $registro = Registro::find($id);

        if (empty($registro)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/registros.singular')])
           );
        }

        $registro->fill($request->all());
        $registro->save();

        return $this->sendResponse(
             $registro->toArray(),
             __('messages.updated', ['model' => __('models/registros.singular')])
        );
    }

    /**
     * Remove the specified Registro from storage.
     * DELETE /registros/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Registro $registro */
        $registro = Registro::find($id);

        if (empty($registro)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/registros.singular')])
           );
        }

        $registro->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/registros.singular')])
         );
    }
}
