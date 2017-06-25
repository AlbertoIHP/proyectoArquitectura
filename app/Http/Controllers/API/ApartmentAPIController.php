<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApartmentAPIRequest;
use App\Http\Requests\API\UpdateApartmentAPIRequest;
use App\Models\Apartment;
use App\Repositories\ApartmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ApartmentController
 * @package App\Http\Controllers\API
 */

class ApartmentAPIController extends AppBaseController
{
    /** @var  ApartmentRepository */
    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepo)
    {
        $this->apartmentRepository = $apartmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/apartments",
     *      summary="Get a listing of the Apartments.",
     *      tags={"Apartment"},
     *      description="Get all Apartments",
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
     *                  @SWG\Items(ref="#/definitions/Apartment")
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
        $this->apartmentRepository->pushCriteria(new RequestCriteria($request));
        $this->apartmentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $apartments = $this->apartmentRepository->all();

        return $this->sendResponse($apartments->toArray(), 'Apartments retrieved successfully');
    }

    /**
     * @param CreateApartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/apartments",
     *      summary="Store a newly created Apartment in storage",
     *      tags={"Apartment"},
     *      description="Store Apartment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Apartment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Apartment")
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
     *                  ref="#/definitions/Apartment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApartmentAPIRequest $request)
    {
        $input = $request->all();

        $apartments = $this->apartmentRepository->create($input);

        return $this->sendResponse($apartments->toArray(), 'Apartment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/apartments/{id}",
     *      summary="Display the specified Apartment",
     *      tags={"Apartment"},
     *      description="Get Apartment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Apartment",
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
     *                  ref="#/definitions/Apartment"
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
        /** @var Apartment $apartment */
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            return $this->sendError('Apartment not found');
        }

        return $this->sendResponse($apartment->toArray(), 'Apartment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateApartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/apartments/{id}",
     *      summary="Update the specified Apartment in storage",
     *      tags={"Apartment"},
     *      description="Update Apartment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Apartment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Apartment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Apartment")
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
     *                  ref="#/definitions/Apartment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApartmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Apartment $apartment */
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            return $this->sendError('Apartment not found');
        }

        $apartment = $this->apartmentRepository->update($input, $id);

        return $this->sendResponse($apartment->toArray(), 'Apartment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/apartments/{id}",
     *      summary="Remove the specified Apartment from storage",
     *      tags={"Apartment"},
     *      description="Delete Apartment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Apartment",
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
        /** @var Apartment $apartment */
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            return $this->sendError('Apartment not found');
        }

        $apartment->delete();

        return $this->sendResponse($id, 'Apartment deleted successfully');
    }
}
