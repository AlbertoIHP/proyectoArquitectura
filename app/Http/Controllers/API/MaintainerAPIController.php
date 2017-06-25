<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMaintainerAPIRequest;
use App\Http\Requests\API\UpdateMaintainerAPIRequest;
use App\Models\Maintainer;
use App\Repositories\MaintainerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MaintainerController
 * @package App\Http\Controllers\API
 */

class MaintainerAPIController extends AppBaseController
{
    /** @var  MaintainerRepository */
    private $maintainerRepository;

    public function __construct(MaintainerRepository $maintainerRepo)
    {
        $this->maintainerRepository = $maintainerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/maintainers",
     *      summary="Get a listing of the Maintainers.",
     *      tags={"Maintainer"},
     *      description="Get all Maintainers",
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
     *                  @SWG\Items(ref="#/definitions/Maintainer")
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
        $this->maintainerRepository->pushCriteria(new RequestCriteria($request));
        $this->maintainerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $maintainers = $this->maintainerRepository->all();

        return $this->sendResponse($maintainers->toArray(), 'Maintainers retrieved successfully');
    }

    /**
     * @param CreateMaintainerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/maintainers",
     *      summary="Store a newly created Maintainer in storage",
     *      tags={"Maintainer"},
     *      description="Store Maintainer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Maintainer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Maintainer")
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
     *                  ref="#/definitions/Maintainer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMaintainerAPIRequest $request)
    {
        $input = $request->all();

        $maintainers = $this->maintainerRepository->create($input);

        return $this->sendResponse($maintainers->toArray(), 'Maintainer saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/maintainers/{id}",
     *      summary="Display the specified Maintainer",
     *      tags={"Maintainer"},
     *      description="Get Maintainer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Maintainer",
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
     *                  ref="#/definitions/Maintainer"
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
        /** @var Maintainer $maintainer */
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            return $this->sendError('Maintainer not found');
        }

        return $this->sendResponse($maintainer->toArray(), 'Maintainer retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMaintainerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/maintainers/{id}",
     *      summary="Update the specified Maintainer in storage",
     *      tags={"Maintainer"},
     *      description="Update Maintainer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Maintainer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Maintainer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Maintainer")
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
     *                  ref="#/definitions/Maintainer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMaintainerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Maintainer $maintainer */
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            return $this->sendError('Maintainer not found');
        }

        $maintainer = $this->maintainerRepository->update($input, $id);

        return $this->sendResponse($maintainer->toArray(), 'Maintainer updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/maintainers/{id}",
     *      summary="Remove the specified Maintainer from storage",
     *      tags={"Maintainer"},
     *      description="Delete Maintainer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Maintainer",
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
        /** @var Maintainer $maintainer */
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            return $this->sendError('Maintainer not found');
        }

        $maintainer->delete();

        return $this->sendResponse($id, 'Maintainer deleted successfully');
    }
}
