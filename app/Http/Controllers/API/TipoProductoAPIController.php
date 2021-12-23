<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoProductoAPIRequest;
use App\Http\Requests\API\UpdateTipoProductoAPIRequest;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TipoProductoController
 * @package App\Http\Controllers\API
 */

class TipoProductoAPIController extends AppBaseController
{
    /**
     * Display a listing of the TipoProducto.
     * GET|HEAD /tipoProductos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = TipoProducto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tipoProductos = $query->get();

         return $this->sendResponse(
             $tipoProductos->toArray(),
             __('messages.retrieved', ['model' => __('models/tipoProductos.plural')])
         );
    }

    /**
     * Store a newly created TipoProducto in storage.
     * POST /tipoProductos
     *
     * @param CreateTipoProductoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoProductoAPIRequest $request)
    {
        $input = $request->all();

        /** @var TipoProducto $tipoProducto */
        $tipoProducto = TipoProducto::create($input);

        return $this->sendResponse(
             $tipoProducto->toArray(),
             __('messages.saved', ['model' => __('models/tipoProductos.singular')])
        );
    }

    /**
     * Display the specified TipoProducto.
     * GET|HEAD /tipoProductos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TipoProducto $tipoProducto */
        $tipoProducto = TipoProducto::find($id);

        if (empty($tipoProducto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/tipoProductos.singular')])
            );
        }

        return $this->sendResponse(
            $tipoProducto->toArray(),
            __('messages.retrieved', ['model' => __('models/tipoProductos.singular')])
        );
    }

    /**
     * Update the specified TipoProducto in storage.
     * PUT/PATCH /tipoProductos/{id}
     *
     * @param int $id
     * @param UpdateTipoProductoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoProductoAPIRequest $request)
    {
        /** @var TipoProducto $tipoProducto */
        $tipoProducto = TipoProducto::find($id);

        if (empty($tipoProducto)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/tipoProductos.singular')])
           );
        }

        $tipoProducto->fill($request->all());
        $tipoProducto->save();

        return $this->sendResponse(
             $tipoProducto->toArray(),
             __('messages.updated', ['model' => __('models/tipoProductos.singular')])
        );
    }

    /**
     * Remove the specified TipoProducto from storage.
     * DELETE /tipoProductos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TipoProducto $tipoProducto */
        $tipoProducto = TipoProducto::find($id);

        if (empty($tipoProducto)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/tipoProductos.singular')])
           );
        }

        $tipoProducto->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/tipoProductos.singular')])
         );
    }
}
