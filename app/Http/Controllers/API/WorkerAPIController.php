<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWorkerAPIRequest;
use App\Http\Requests\API\UpdateWorkerAPIRequest;
use App\Models\Worker;
use App\Repositories\WorkerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class WorkerController
 * @package App\Http\Controllers\API
 */

class WorkerAPIController extends AppBaseController
{
    /** @var  WorkerRepository */
    private $workerRepository;

    public function __construct(WorkerRepository $workerRepo)
    {
        $this->workerRepository = $workerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/workers",
     *      summary="Get a listing of the Workers.",
     *      tags={"Worker"},
     *      description="Get all Workers",
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
     *                  @SWG\Items(ref="#/definitions/Worker")
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
        $this->workerRepository->pushCriteria(new RequestCriteria($request));
        $this->workerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $workers = $this->workerRepository->all();

        return $this->sendResponse($workers->toArray(), 'Workers retrieved successfully');
    }

    /**
     * @param CreateWorkerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/workers",
     *      summary="Store a newly created Worker in storage",
     *      tags={"Worker"},
     *      description="Store Worker",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Worker that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Worker")
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
     *                  ref="#/definitions/Worker"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateWorkerAPIRequest $request)
    {
        $input = $request->all();

        $workers = $this->workerRepository->create($input);

        return $this->sendResponse($workers->toArray(), 'Worker saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/workers/{id}",
     *      summary="Display the specified Worker",
     *      tags={"Worker"},
     *      description="Get Worker",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Worker",
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
     *                  ref="#/definitions/Worker"
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
        /** @var Worker $worker */
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            return $this->sendError('Worker not found');
        }

        return $this->sendResponse($worker->toArray(), 'Worker retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateWorkerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/workers/{id}",
     *      summary="Update the specified Worker in storage",
     *      tags={"Worker"},
     *      description="Update Worker",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Worker",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Worker that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Worker")
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
     *                  ref="#/definitions/Worker"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateWorkerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Worker $worker */
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            return $this->sendError('Worker not found');
        }

        $worker = $this->workerRepository->update($input, $id);

        return $this->sendResponse($worker->toArray(), 'Worker updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/workers/{id}",
     *      summary="Remove the specified Worker from storage",
     *      tags={"Worker"},
     *      description="Delete Worker",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Worker",
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
        /** @var Worker $worker */
        $worker = $this->workerRepository->findWithoutFail($id);

        if (empty($worker)) {
            return $this->sendError('Worker not found');
        }

        $worker->delete();

        return $this->sendResponse($id, 'Worker deleted successfully');
    }
}
