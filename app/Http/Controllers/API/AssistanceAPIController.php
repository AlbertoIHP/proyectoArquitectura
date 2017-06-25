<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAssistanceAPIRequest;
use App\Http\Requests\API\UpdateAssistanceAPIRequest;
use App\Models\Assistance;
use App\Repositories\AssistanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AssistanceController
 * @package App\Http\Controllers\API
 */

class AssistanceAPIController extends AppBaseController
{
    /** @var  AssistanceRepository */
    private $assistanceRepository;

    public function __construct(AssistanceRepository $assistanceRepo)
    {
        $this->assistanceRepository = $assistanceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/assistances",
     *      summary="Get a listing of the Assistances.",
     *      tags={"Assistance"},
     *      description="Get all Assistances",
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
     *                  @SWG\Items(ref="#/definitions/Assistance")
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
        $this->assistanceRepository->pushCriteria(new RequestCriteria($request));
        $this->assistanceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $assistances = $this->assistanceRepository->all();

        return $this->sendResponse($assistances->toArray(), 'Assistances retrieved successfully');
    }

    /**
     * @param CreateAssistanceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/assistances",
     *      summary="Store a newly created Assistance in storage",
     *      tags={"Assistance"},
     *      description="Store Assistance",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Assistance that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assistance")
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
     *                  ref="#/definitions/Assistance"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAssistanceAPIRequest $request)
    {
        $input = $request->all();

        $assistances = $this->assistanceRepository->create($input);

        return $this->sendResponse($assistances->toArray(), 'Assistance saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/assistances/{id}",
     *      summary="Display the specified Assistance",
     *      tags={"Assistance"},
     *      description="Get Assistance",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assistance",
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
     *                  ref="#/definitions/Assistance"
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
        /** @var Assistance $assistance */
        $assistance = $this->assistanceRepository->findWithoutFail($id);

        if (empty($assistance)) {
            return $this->sendError('Assistance not found');
        }

        return $this->sendResponse($assistance->toArray(), 'Assistance retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAssistanceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/assistances/{id}",
     *      summary="Update the specified Assistance in storage",
     *      tags={"Assistance"},
     *      description="Update Assistance",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assistance",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Assistance that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assistance")
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
     *                  ref="#/definitions/Assistance"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAssistanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Assistance $assistance */
        $assistance = $this->assistanceRepository->findWithoutFail($id);

        if (empty($assistance)) {
            return $this->sendError('Assistance not found');
        }

        $assistance = $this->assistanceRepository->update($input, $id);

        return $this->sendResponse($assistance->toArray(), 'Assistance updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/assistances/{id}",
     *      summary="Remove the specified Assistance from storage",
     *      tags={"Assistance"},
     *      description="Delete Assistance",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assistance",
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
        /** @var Assistance $assistance */
        $assistance = $this->assistanceRepository->findWithoutFail($id);

        if (empty($assistance)) {
            return $this->sendError('Assistance not found');
        }

        $assistance->delete();

        return $this->sendResponse($id, 'Assistance deleted successfully');
    }
}
