<?php

namespace App\Http\Controllers;

use App\DataTables\BuildingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use App\Repositories\BuildingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class BuildingController extends AppBaseController
{
    /** @var  BuildingRepository */
    private $buildingRepository;

    public function __construct(BuildingRepository $buildingRepo)
    {
        $this->buildingRepository = $buildingRepo;
    }

    /**
     * Display a listing of the Building.
     *
     * @param BuildingDataTable $buildingDataTable
     * @return Response
     */
    public function index(BuildingDataTable $buildingDataTable)
    {
        return $buildingDataTable->render('buildings.index');
    }

    /**
     * Show the form for creating a new Building.
     *
     * @return Response
     */
    public function create()
    {
        return view('buildings.create');
    }

    /**
     * Store a newly created Building in storage.
     *
     * @param CreateBuildingRequest $request
     *
     * @return Response
     */
    public function store(CreateBuildingRequest $request)
    {
        $input = $request->all();

        $building = $this->buildingRepository->create($input);

        Flash::success('Building saved successfully.');

        return redirect(route('buildings.index'));
    }

    /**
     * Display the specified Building.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            Flash::error('Building not found');

            return redirect(route('buildings.index'));
        }

        return view('buildings.show')->with('building', $building);
    }

    /**
     * Show the form for editing the specified Building.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            Flash::error('Building not found');

            return redirect(route('buildings.index'));
        }

        return view('buildings.edit')->with('building', $building);
    }

    /**
     * Update the specified Building in storage.
     *
     * @param  int              $id
     * @param UpdateBuildingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBuildingRequest $request)
    {
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            Flash::error('Building not found');

            return redirect(route('buildings.index'));
        }

        $building = $this->buildingRepository->update($request->all(), $id);

        Flash::success('Building updated successfully.');

        return redirect(route('buildings.index'));
    }

    /**
     * Remove the specified Building from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $building = $this->buildingRepository->findWithoutFail($id);

        if (empty($building)) {
            Flash::error('Building not found');

            return redirect(route('buildings.index'));
        }

        $this->buildingRepository->delete($id);

        Flash::success('Building deleted successfully.');

        return redirect(route('buildings.index'));
    }
}
