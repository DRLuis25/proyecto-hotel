<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMedioPagoAPIRequest;
use App\Http\Requests\API\UpdateMedioPagoAPIRequest;
use App\Models\MedioPago;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedioPagoController
 * @package App\Http\Controllers\API
 */

class MedioPagoAPIController extends AppBaseController
{
    /**
     * Display a listing of the MedioPago.
     * GET|HEAD /medioPagos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = MedioPago::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $medioPagos = $query->get();

         return $this->sendResponse(
             $medioPagos->toArray(),
             __('messages.retrieved', ['model' => __('models/medioPagos.plural')])
         );
    }

    /**
     * Store a newly created MedioPago in storage.
     * POST /medioPagos
     *
     * @param CreateMedioPagoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMedioPagoAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedioPago $medioPago */
        $medioPago = MedioPago::create($input);

        return $this->sendResponse(
             $medioPago->toArray(),
             __('messages.saved', ['model' => __('models/medioPagos.singular')])
        );
    }

    /**
     * Display the specified MedioPago.
     * GET|HEAD /medioPagos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MedioPago $medioPago */
        $medioPago = MedioPago::find($id);

        if (empty($medioPago)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/medioPagos.singular')])
            );
        }

        return $this->sendResponse(
            $medioPago->toArray(),
            __('messages.retrieved', ['model' => __('models/medioPagos.singular')])
        );
    }

    /**
     * Update the specified MedioPago in storage.
     * PUT/PATCH /medioPagos/{id}
     *
     * @param int $id
     * @param UpdateMedioPagoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedioPagoAPIRequest $request)
    {
        /** @var MedioPago $medioPago */
        $medioPago = MedioPago::find($id);

        if (empty($medioPago)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/medioPagos.singular')])
           );
        }

        $medioPago->fill($request->all());
        $medioPago->save();

        return $this->sendResponse(
             $medioPago->toArray(),
             __('messages.updated', ['model' => __('models/medioPagos.singular')])
        );
    }

    /**
     * Remove the specified MedioPago from storage.
     * DELETE /medioPagos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MedioPago $medioPago */
        $medioPago = MedioPago::find($id);

        if (empty($medioPago)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/medioPagos.singular')])
           );
        }

        $medioPago->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/medioPagos.singular')])
         );
    }
}
