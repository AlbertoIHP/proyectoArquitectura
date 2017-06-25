<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentAPIRequest;
use App\Http\Requests\API\UpdatePaymentAPIRequest;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PaymentController
 * @package App\Http\Controllers\API
 */

class PaymentAPIController extends AppBaseController
{
    /** @var  PaymentRepository */
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo)
    {
        $this->paymentRepository = $paymentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/payments",
     *      summary="Get a listing of the Payments.",
     *      tags={"Payment"},
     *      description="Get all Payments",
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
     *                  @SWG\Items(ref="#/definitions/Payment")
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
        $this->paymentRepository->pushCriteria(new RequestCriteria($request));
        $this->paymentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $payments = $this->paymentRepository->all();

        return $this->sendResponse($payments->toArray(), 'Payments retrieved successfully');
    }

    /**
     * @param CreatePaymentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/payments",
     *      summary="Store a newly created Payment in storage",
     *      tags={"Payment"},
     *      description="Store Payment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Payment that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Payment")
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
     *                  ref="#/definitions/Payment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaymentAPIRequest $request)
    {
        $input = $request->all();

        $payments = $this->paymentRepository->create($input);

        return $this->sendResponse($payments->toArray(), 'Payment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/payments/{id}",
     *      summary="Display the specified Payment",
     *      tags={"Payment"},
     *      description="Get Payment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Payment",
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
     *                  ref="#/definitions/Payment"
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
        /** @var Payment $payment */
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            return $this->sendError('Payment not found');
        }

        return $this->sendResponse($payment->toArray(), 'Payment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePaymentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/payments/{id}",
     *      summary="Update the specified Payment in storage",
     *      tags={"Payment"},
     *      description="Update Payment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Payment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Payment that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Payment")
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
     *                  ref="#/definitions/Payment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaymentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Payment $payment */
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            return $this->sendError('Payment not found');
        }

        $payment = $this->paymentRepository->update($input, $id);

        return $this->sendResponse($payment->toArray(), 'Payment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/payments/{id}",
     *      summary="Remove the specified Payment from storage",
     *      tags={"Payment"},
     *      description="Delete Payment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Payment",
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
        /** @var Payment $payment */
        $payment = $this->paymentRepository->findWithoutFail($id);

        if (empty($payment)) {
            return $this->sendError('Payment not found');
        }

        $payment->delete();

        return $this->sendResponse($id, 'Payment deleted successfully');
    }
}
