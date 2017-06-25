<?php

namespace App\Http\Controllers;

use App\DataTables\MaintenanceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Repositories\MaintenanceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MaintenanceController extends AppBaseController
{
    /** @var  MaintenanceRepository */
    private $maintenanceRepository;

    public function __construct(MaintenanceRepository $maintenanceRepo)
    {
        $this->maintenanceRepository = $maintenanceRepo;
    }

    /**
     * Display a listing of the Maintenance.
     *
     * @param MaintenanceDataTable $maintenanceDataTable
     * @return Response
     */
    public function index(MaintenanceDataTable $maintenanceDataTable)
    {
        return $maintenanceDataTable->render('maintenances.index');
    }

    /**
     * Show the form for creating a new Maintenance.
     *
     * @return Response
     */
    public function create()
    {


         //Se cruza con el modelo de la clave foranea
        $maintainers = \App\Models\Maintainer::pluck('name', 'id');
        $calendars = \App\Models\Calendar::pluck('name', 'id');
        return view('maintenances.create')->with('maintainers',$maintainers)->with('calendars',$calendars);
    }

    /**
     * Store a newly created Maintenance in storage.
     *
     * @param CreateMaintenanceRequest $request
     *
     * @return Response
     */
    public function store(CreateMaintenanceRequest $request)
    {
        $input = $request->all();

        $maintenance = $this->maintenanceRepository->create($input);

        Flash::success('Maintenance saved successfully.');

        return redirect(route('maintenances.index'));
    }

    /**
     * Display the specified Maintenance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $maintenance = $this->maintenanceRepository->findWithoutFail($id);

        if (empty($maintenance)) {
            Flash::error('Maintenance not found');

            return redirect(route('maintenances.index'));
        }

        return view('maintenances.show')->with('maintenance', $maintenance);
    }

    /**
     * Show the form for editing the specified Maintenance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $maintenance = $this->maintenanceRepository->findWithoutFail($id);

        if (empty($maintenance)) {
            Flash::error('Maintenance not found');

            return redirect(route('maintenances.index'));
        }

        return view('maintenances.edit')->with('maintenance', $maintenance);
    }

    /**
     * Update the specified Maintenance in storage.
     *
     * @param  int              $id
     * @param UpdateMaintenanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaintenanceRequest $request)
    {
        $maintenance = $this->maintenanceRepository->findWithoutFail($id);

        if (empty($maintenance)) {
            Flash::error('Maintenance not found');

            return redirect(route('maintenances.index'));
        }

        $maintenance = $this->maintenanceRepository->update($request->all(), $id);

        Flash::success('Maintenance updated successfully.');

        return redirect(route('maintenances.index'));
    }

    /**
     * Remove the specified Maintenance from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $maintenance = $this->maintenanceRepository->findWithoutFail($id);

        if (empty($maintenance)) {
            Flash::error('Maintenance not found');

            return redirect(route('maintenances.index'));
        }

        $this->maintenanceRepository->delete($id);

        Flash::success('Maintenance deleted successfully.');

        return redirect(route('maintenances.index'));
    }
}
