<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpaceAPIRequest;
use App\Http\Requests\API\UpdateSpaceAPIRequest;
use App\Models\Space;
use App\Repositories\SpaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SpaceController
 * @package App\Http\Controllers\API
 */

class SpaceAPIController extends AppBaseController
{
    /** @var  SpaceRepository */
    private $spaceRepository;

    public function __construct(SpaceRepository $spaceRepo)
    {
        $this->spaceRepository = $spaceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/spaces",
     *      summary="Get a listing of the Spaces.",
     *      tags={"Space"},
     *      description="Get all Spaces",
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
     *                  @SWG\Items(ref="#/definitions/Space")
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
        $this->spaceRepository->pushCriteria(new RequestCriteria($request));
        $this->spaceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $spaces = $this->spaceRepository->all();

        return $this->sendResponse($spaces->toArray(), 'Spaces retrieved successfully');
    }

    /**
     * @param CreateSpaceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/spaces",
     *      summary="Store a newly created Space in storage",
     *      tags={"Space"},
     *      description="Store Space",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Space that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Space")
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
     *                  ref="#/definitions/Space"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSpaceAPIRequest $request)
    {
        $input = $request->all();

        $spaces = $this->spaceRepository->create($input);

        return $this->sendResponse($spaces->toArray(), 'Space saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/spaces/{id}",
     *      summary="Display the specified Space",
     *      tags={"Space"},
     *      description="Get Space",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Space",
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
     *                  ref="#/definitions/Space"
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
        /** @var Space $space */
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            return $this->sendError('Space not found');
        }

        return $this->sendResponse($space->toArray(), 'Space retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSpaceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/spaces/{id}",
     *      summary="Update the specified Space in storage",
     *      tags={"Space"},
     *      description="Update Space",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Space",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Space that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Space")
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
     *                  ref="#/definitions/Space"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSpaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Space $space */
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            return $this->sendError('Space not found');
        }

        $space = $this->spaceRepository->update($input, $id);

        return $this->sendResponse($space->toArray(), 'Space updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/spaces/{id}",
     *      summary="Remove the specified Space from storage",
     *      tags={"Space"},
     *      description="Delete Space",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Space",
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
        /** @var Space $space */
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            return $this->sendError('Space not found');
        }

        $space->delete();

        return $this->sendResponse($id, 'Space deleted successfully');
    }
}
