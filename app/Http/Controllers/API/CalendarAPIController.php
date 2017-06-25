<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCalendarAPIRequest;
use App\Http\Requests\API\UpdateCalendarAPIRequest;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CalendarController
 * @package App\Http\Controllers\API
 */

class CalendarAPIController extends AppBaseController
{
    /** @var  CalendarRepository */
    private $calendarRepository;

    public function __construct(CalendarRepository $calendarRepo)
    {
        $this->calendarRepository = $calendarRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/calendars",
     *      summary="Get a listing of the Calendars.",
     *      tags={"Calendar"},
     *      description="Get all Calendars",
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
     *                  @SWG\Items(ref="#/definitions/Calendar")
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
        $this->calendarRepository->pushCriteria(new RequestCriteria($request));
        $this->calendarRepository->pushCriteria(new LimitOffsetCriteria($request));
        $calendars = $this->calendarRepository->all();

        return $this->sendResponse($calendars->toArray(), 'Calendars retrieved successfully');
    }

    /**
     * @param CreateCalendarAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/calendars",
     *      summary="Store a newly created Calendar in storage",
     *      tags={"Calendar"},
     *      description="Store Calendar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Calendar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Calendar")
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
     *                  ref="#/definitions/Calendar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCalendarAPIRequest $request)
    {
        $input = $request->all();

        $calendars = $this->calendarRepository->create($input);

        return $this->sendResponse($calendars->toArray(), 'Calendar saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/calendars/{id}",
     *      summary="Display the specified Calendar",
     *      tags={"Calendar"},
     *      description="Get Calendar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Calendar",
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
     *                  ref="#/definitions/Calendar"
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
        /** @var Calendar $calendar */
        $calendar = $this->calendarRepository->findWithoutFail($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        return $this->sendResponse($calendar->toArray(), 'Calendar retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCalendarAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/calendars/{id}",
     *      summary="Update the specified Calendar in storage",
     *      tags={"Calendar"},
     *      description="Update Calendar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Calendar",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Calendar that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Calendar")
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
     *                  ref="#/definitions/Calendar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCalendarAPIRequest $request)
    {
        $input = $request->all();

        /** @var Calendar $calendar */
        $calendar = $this->calendarRepository->findWithoutFail($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        $calendar = $this->calendarRepository->update($input, $id);

        return $this->sendResponse($calendar->toArray(), 'Calendar updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/calendars/{id}",
     *      summary="Remove the specified Calendar from storage",
     *      tags={"Calendar"},
     *      description="Delete Calendar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Calendar",
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
        /** @var Calendar $calendar */
        $calendar = $this->calendarRepository->findWithoutFail($id);

        if (empty($calendar)) {
            return $this->sendError('Calendar not found');
        }

        $calendar->delete();

        return $this->sendResponse($id, 'Calendar deleted successfully');
    }
}
