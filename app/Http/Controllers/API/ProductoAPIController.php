<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductoAPIRequest;
use App\Http\Requests\API\UpdateProductoAPIRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProductoController
 * @package App\Http\Controllers\API
 */

class ProductoAPIController extends AppBaseController
{
    /**
     * Display a listing of the Producto.
     * GET|HEAD /productos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $productos = $query->get();

         return $this->sendResponse(
             $productos->toArray(),
             __('messages.retrieved', ['model' => __('models/productos.plural')])
         );
    }

    /**
     * Store a newly created Producto in storage.
     * POST /productos
     *
     * @param CreateProductoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Producto $producto */
        $producto = Producto::create($input);

        return $this->sendResponse(
             $producto->toArray(),
             __('messages.saved', ['model' => __('models/productos.singular')])
        );
    }

    /**
     * Display the specified Producto.
     * GET|HEAD /productos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Producto $producto */
        $producto = Producto::find($id);

        if (empty($producto)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/productos.singular')])
            );
        }

        return $this->sendResponse(
            $producto->toArray(),
            __('messages.retrieved', ['model' => __('models/productos.singular')])
        );
    }

    /**
     * Update the specified Producto in storage.
     * PUT/PATCH /productos/{id}
     *
     * @param int $id
     * @param UpdateProductoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductoAPIRequest $request)
    {
        /** @var Producto $producto */
        $producto = Producto::find($id);

        if (empty($producto)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/productos.singular')])
           );
        }

        $producto->fill($request->all());
        $producto->save();

        return $this->sendResponse(
             $producto->toArray(),
             __('messages.updated', ['model' => __('models/productos.singular')])
        );
    }

    /**
     * Remove the specified Producto from storage.
     * DELETE /productos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Producto $producto */
        $producto = Producto::find($id);

        if (empty($producto)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/productos.singular')])
           );
        }

        $producto->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/productos.singular')])
         );
    }
}
