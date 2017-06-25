<?php

namespace App\Http\Controllers;

use App\DataTables\ShiftTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateShiftTypeRequest;
use App\Http\Requests\UpdateShiftTypeRequest;
use App\Repositories\ShiftTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ShiftTypeController extends AppBaseController
{
    /** @var  ShiftTypeRepository */
    private $shiftTypeRepository;

    public function __construct(ShiftTypeRepository $shiftTypeRepo)
    {
        $this->shiftTypeRepository = $shiftTypeRepo;
    }

    /**
     * Display a listing of the ShiftType.
     *
     * @param ShiftTypeDataTable $shiftTypeDataTable
     * @return Response
     */
    public function index(ShiftTypeDataTable $shiftTypeDataTable)
    {
        return $shiftTypeDataTable->render('shift_types.index');
    }

    /**
     * Show the form for creating a new ShiftType.
     *
     * @return Response
     */
    public function create()
    {
        return view('shift_types.create');
    }

    /**
     * Store a newly created ShiftType in storage.
     *
     * @param CreateShiftTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateShiftTypeRequest $request)
    {
        $input = $request->all();

        $shiftType = $this->shiftTypeRepository->create($input);

        Flash::success('Shift Type saved successfully.');

        return redirect(route('shiftTypes.index'));
    }

    /**
     * Display the specified ShiftType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            Flash::error('Shift Type not found');

            return redirect(route('shiftTypes.index'));
        }

        return view('shift_types.show')->with('shiftType', $shiftType);
    }

    /**
     * Show the form for editing the specified ShiftType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            Flash::error('Shift Type not found');

            return redirect(route('shiftTypes.index'));
        }

        return view('shift_types.edit')->with('shiftType', $shiftType);
    }

    /**
     * Update the specified ShiftType in storage.
     *
     * @param  int              $id
     * @param UpdateShiftTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShiftTypeRequest $request)
    {
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            Flash::error('Shift Type not found');

            return redirect(route('shiftTypes.index'));
        }

        $shiftType = $this->shiftTypeRepository->update($request->all(), $id);

        Flash::success('Shift Type updated successfully.');

        return redirect(route('shiftTypes.index'));
    }

    /**
     * Remove the specified ShiftType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shiftType = $this->shiftTypeRepository->findWithoutFail($id);

        if (empty($shiftType)) {
            Flash::error('Shift Type not found');

            return redirect(route('shiftTypes.index'));
        }

        $this->shiftTypeRepository->delete($id);

        Flash::success('Shift Type deleted successfully.');

        return redirect(route('shiftTypes.index'));
    }
}
