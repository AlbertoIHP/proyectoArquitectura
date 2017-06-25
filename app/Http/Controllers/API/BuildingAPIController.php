<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBuildingAPIRequest;
use App\Http\Requests\API\UpdateBuildingAPIRequest;
use App\Models\Building;
use App\Repositories\BuildingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BuildingController
 * @package App\Http\Controllers\API
 */

class BuildingAPIController extends AppBaseController
{
    /** @var  BuildingRepository */
    private $buildingRepository;

    public function __construct(BuildingRepository $buildingRepo)
    {
        $this->buildingRepository = $buildingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/buildings",
     *      summary="Get a listing of the Buildings.",
     *      tags={"Building"},
     *      description="Get all Buildings",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Building")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->buildingRepository->pushCriteria(new RequestCriteria($request));
        $this->buildingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $buildings = $this->buildingRepository->all();

        return $this->sendResponse($buildings->toArray(), 'Buildings retrieved successfully');
    }

    /**
     * @param CreateBuildingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/buildings",
     *      summary="Store a newly created Building in storage",
     *      tags={"Building"},
     *      description="Store Building",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Building that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Building")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Building"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBuildingAPIRequest $request)
    {
        $input = $request->all();

        $buildings = $this->buildingRepository->create($input);

        return $this->sendResponse($buildings->toArray(), 'Building saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/buildings/{id}",
     *      summary="Display the specified Building",
     *      tags={"Building"},
     *      description="Get Building",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Building",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Building"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Building $building */
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            return $this->sendError('Building not found');
        }

        return $this->sendResponse($building->toArray(), 'Building retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBuildingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/buildings/{id}",
     *      summary="Update the specified Building in storage",
     *      tags={"Building"},
     *      description="Update Building",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Building",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Building that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Building")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Building"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBuildingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Building $building */
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            return $this->sendError('Building not found');
        }

        $building = $this->buildingRepository->update($input, $id);

        return $this->sendResponse($building->toArray(), 'Building updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/buildings/{id}",
     *      summary="Remove the specified Building from storage",
     *      tags={"Building"},
     *      description="Delete Building",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Building",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Building $building */
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            return $this->sendError('Building not found');
        }

        $building->delete();

        return $this->sendResponse($id, 'Building deleted successfully');
    }
}
