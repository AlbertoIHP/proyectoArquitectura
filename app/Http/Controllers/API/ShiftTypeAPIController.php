<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateShiftTypeAPIRequest;
use App\Http\Requests\API\UpdateShiftTypeAPIRequest;
use App\Models\ShiftType;
use App\Repositories\ShiftTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ShiftTypeController
 * @package App\Http\Controllers\API
 */

class ShiftTypeAPIController extends AppBaseController
{
    /** @var  ShiftTypeRepository */
    private $shiftTypeRepository;

    public function __construct(ShiftTypeRepository $shiftTypeRepo)
    {
        $this->shiftTypeRepository = $shiftTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/shiftTypes",
     *      summary="Get a listing of the ShiftTypes.",
     *      tags={"ShiftType"},
     *      description="Get all ShiftTypes",
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
     *                  @SWG\Items(ref="#/definitions/ShiftType")
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
        $this->shiftTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->shiftTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $shiftTypes = $this->shiftTypeRepository->all();

        return $this->sendResponse($shiftTypes->toArray(), 'Shift Types retrieved successfully');
    }

    /**
     * @param CreateShiftTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/shiftTypes",
     *      summary="Store a newly created ShiftType in storage",
     *      tags={"ShiftType"},
     *      description="Store ShiftType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShiftType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShiftType")
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
     *                  ref="#/definitions/ShiftType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateShiftTypeAPIRequest $request)
    {
        $input = $request->all();

        $shiftTypes = $this->shiftTypeRepository->create($input);

        return $this->sendResponse($shiftTypes->toArray(), 'Shift Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/shiftTypes/{id}",
     *      summary="Display the specified ShiftType",
     *      tags={"ShiftType"},
     *      description="Get ShiftType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShiftType",
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
     *                  ref="#/definitions/ShiftType"
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
        /** @var ShiftType $shiftType */
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            return $this->sendError('Shift Type not found');
        }

        return $this->sendResponse($shiftType->toArray(), 'Shift Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateShiftTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/shiftTypes/{id}",
     *      summary="Update the specified ShiftType in storage",
     *      tags={"ShiftType"},
     *      description="Update ShiftType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShiftType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ShiftType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ShiftType")
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
     *                  ref="#/definitions/ShiftType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateShiftTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ShiftType $shiftType */
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            return $this->sendError('Shift Type not found');
        }

        $shiftType = $this->shiftTypeRepository->update($input, $id);

        return $this->sendResponse($shiftType->toArray(), 'ShiftType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/shiftTypes/{id}",
     *      summary="Remove the specified ShiftType from storage",
     *      tags={"ShiftType"},
     *      description="Delete ShiftType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ShiftType",
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
        /** @var ShiftType $shiftType */
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            return $this->sendError('Shift Type not found');
        }

        $shiftType->delete();

        return $this->sendResponse($id, 'Shift Type deleted successfully');
    }
}
