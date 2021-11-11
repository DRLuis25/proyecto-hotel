<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHabitacionAPIRequest;
use App\Http\Requests\API\UpdateHabitacionAPIRequest;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HabitacionController
 * @package App\Http\Controllers\API
 */

class HabitacionAPIController extends AppBaseController
{
    /**
     * Display a listing of the Habitacion.
     * GET|HEAD /habitacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Habitacion::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $habitacions = $query->get();

         return $this->sendResponse(
             $habitacions->toArray(),
             __('messages.retrieved', ['model' => __('models/habitacions.plural')])
         );
    }

    /**
     * Store a newly created Habitacion in storage.
     * POST /habitacions
     *
     * @param CreateHabitacionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHabitacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Habitacion $habitacion */
        $habitacion = Habitacion::create($input);

        return $this->sendResponse(
             $habitacion->toArray(),
             __('messages.saved', ['model' => __('models/habitacions.singular')])
        );
    }

    /**
     * Display the specified Habitacion.
     * GET|HEAD /habitacions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Habitacion $habitacion */
        $habitacion = Habitacion::find($id);

        if (empty($habitacion)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/habitacions.singular')])
            );
        }

        return $this->sendResponse(
            $habitacion->toArray(),
            __('messages.retrieved', ['model' => __('models/habitacions.singular')])
        );
    }

    /**
     * Update the specified Habitacion in storage.
     * PUT/PATCH /habitacions/{id}
     *
     * @param int $id
     * @param UpdateHabitacionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHabitacionAPIRequest $request)
    {
        /** @var Habitacion $habitacion */
        $habitacion = Habitacion::find($id);

        if (empty($habitacion)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/habitacions.singular')])
           );
        }

        $habitacion->fill($request->all());
        $habitacion->save();

        return $this->sendResponse(
             $habitacion->toArray(),
             __('messages.updated', ['model' => __('models/habitacions.singular')])
        );
    }

    /**
     * Remove the specified Habitacion from storage.
     * DELETE /habitacions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Habitacion $habitacion */
        $habitacion = Habitacion::find($id);

        if (empty($habitacion)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/habitacions.singular')])
           );
        }

        $habitacion->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/habitacions.singular')])
         );
    }
}
