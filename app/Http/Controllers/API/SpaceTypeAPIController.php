<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpaceTypeAPIRequest;
use App\Http\Requests\API\UpdateSpaceTypeAPIRequest;
use App\Models\SpaceType;
use App\Repositories\SpaceTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SpaceTypeController
 * @package App\Http\Controllers\API
 */

class SpaceTypeAPIController extends AppBaseController
{
    /** @var  SpaceTypeRepository */
    private $spaceTypeRepository;

    public function __construct(SpaceTypeRepository $spaceTypeRepo)
    {
        $this->spaceTypeRepository = $spaceTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/spaceTypes",
     *      summary="Get a listing of the SpaceTypes.",
     *      tags={"SpaceType"},
     *      description="Get all SpaceTypes",
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
     *                  @SWG\Items(ref="#/definitions/SpaceType")
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
        $this->spaceTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->spaceTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $spaceTypes = $this->spaceTypeRepository->all();

        return $this->sendResponse($spaceTypes->toArray(), 'Space Types retrieved successfully');
    }

    /**
     * @param CreateSpaceTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/spaceTypes",
     *      summary="Store a newly created SpaceType in storage",
     *      tags={"SpaceType"},
     *      description="Store SpaceType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpaceType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpaceType")
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
     *                  ref="#/definitions/SpaceType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpaceTypeAPIRequest $request)
    {
        $input = $request->all();

        $spaceTypes = $this->spaceTypeRepository->create($input);

        return $this->sendResponse($spaceTypes->toArray(), 'Space Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/spaceTypes/{id}",
     *      summary="Display the specified SpaceType",
     *      tags={"SpaceType"},
     *      description="Get SpaceType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpaceType",
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
     *                  ref="#/definitions/SpaceType"
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
        /** @var SpaceType $spaceType */
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            return $this->sendError('Space Type not found');
        }

        return $this->sendResponse($spaceType->toArray(), 'Space Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpaceTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/spaceTypes/{id}",
     *      summary="Update the specified SpaceType in storage",
     *      tags={"SpaceType"},
     *      description="Update SpaceType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpaceType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SpaceType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SpaceType")
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
     *                  ref="#/definitions/SpaceType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpaceTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpaceType $spaceType */
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            return $this->sendError('Space Type not found');
        }

        $spaceType = $this->spaceTypeRepository->update($input, $id);

        return $this->sendResponse($spaceType->toArray(), 'SpaceType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/spaceTypes/{id}",
     *      summary="Remove the specified SpaceType from storage",
     *      tags={"SpaceType"},
     *      description="Delete SpaceType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SpaceType",
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
        /** @var SpaceType $spaceType */
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            return $this->sendError('Space Type not found');
        }

        $spaceType->delete();

        return $this->sendResponse($id, 'Space Type deleted successfully');
    }
}
