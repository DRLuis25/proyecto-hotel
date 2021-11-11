<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClienteAPIRequest;
use App\Http\Requests\API\UpdateClienteAPIRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClienteController
 * @package App\Http\Controllers\API
 */

class ClienteAPIController extends AppBaseController
{
    /**
     * Display a listing of the Cliente.
     * GET|HEAD /clientes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $clientes = $query->get();

         return $this->sendResponse(
             $clientes->toArray(),
             __('messages.retrieved', ['model' => __('models/clientes.plural')])
         );
    }

    /**
     * Store a newly created Cliente in storage.
     * POST /clientes
     *
     * @param CreateClienteAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClienteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Cliente $cliente */
        $cliente = Cliente::create($input);

        return $this->sendResponse(
             $cliente->toArray(),
             __('messages.saved', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Display the specified Cliente.
     * GET|HEAD /clientes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/clientes.singular')])
            );
        }

        return $this->sendResponse(
            $cliente->toArray(),
            __('messages.retrieved', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Update the specified Cliente in storage.
     * PUT/PATCH /clientes/{id}
     *
     * @param int $id
     * @param UpdateClienteAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClienteAPIRequest $request)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/clientes.singular')])
           );
        }

        $cliente->fill($request->all());
        $cliente->save();

        return $this->sendResponse(
             $cliente->toArray(),
             __('messages.updated', ['model' => __('models/clientes.singular')])
        );
    }

    /**
     * Remove the specified Cliente from storage.
     * DELETE /clientes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Cliente $cliente */
        $cliente = Cliente::find($id);

        if (empty($cliente)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/clientes.singular')])
           );
        }

        $cliente->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/clientes.singular')])
         );
    }
}
