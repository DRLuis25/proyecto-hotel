<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAreaAPIRequest;
use App\Http\Requests\API\UpdateAreaAPIRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AreaController
 * @package App\Http\Controllers\API
 */

class AreaAPIController extends AppBaseController
{
    /**
     * Display a listing of the Area.
     * GET|HEAD /areas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Area::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $areas = $query->get();

         return $this->sendResponse(
             $areas->toArray(),
             __('messages.retrieved', ['model' => __('models/areas.plural')])
         );
    }

    /**
     * Store a newly created Area in storage.
     * POST /areas
     *
     * @param CreateAreaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAreaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Area $area */
        $area = Area::create($input);

        return $this->sendResponse(
             $area->toArray(),
             __('messages.saved', ['model' => __('models/areas.singular')])
        );
    }

    /**
     * Display the specified Area.
     * GET|HEAD /areas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Area $area */
        $area = Area::find($id);

        if (empty($area)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/areas.singular')])
            );
        }

        return $this->sendResponse(
            $area->toArray(),
            __('messages.retrieved', ['model' => __('models/areas.singular')])
        );
    }

    /**
     * Update the specified Area in storage.
     * PUT/PATCH /areas/{id}
     *
     * @param int $id
     * @param UpdateAreaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAreaAPIRequest $request)
    {
        /** @var Area $area */
        $area = Area::find($id);

        if (empty($area)) {
           return $this->sendError(
               __('messages.not_found', ['model' => __('models/areas.singular')])
           );
        }

        $area->fill($request->all());
        $area->save();

        return $this->sendResponse(
             $area->toArray(),
             __('messages.updated', ['model' => __('models/areas.singular')])
        );
    }

    /**
     * Remove the specified Area from storage.
     * DELETE /areas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Area $area */
        $area = Area::find($id);

        if (empty($area)) {
           return $this->sendError(
                 __('messages.not_found', ['model' => __('models/areas.singular')])
           );
        }

        $area->delete();

         return $this->sendResponse(
             $id,
             __('messages.deleted', ['model' => __('models/areas.singular')])
         );
    }
}
