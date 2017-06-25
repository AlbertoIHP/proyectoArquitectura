<?php

namespace App\Http\Controllers;

use App\DataTables\SpaceTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSpaceTypeRequest;
use App\Http\Requests\UpdateSpaceTypeRequest;
use App\Repositories\SpaceTypeRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SpaceTypeController extends AppBaseController
{
    /** @var  SpaceTypeRepository */
    private $spaceTypeRepository;

    public function __construct(SpaceTypeRepository $spaceTypeRepo)
    {
        $this->spaceTypeRepository = $spaceTypeRepo;
    }

    /**
     * Display a listing of the SpaceType.
     *
     * @param SpaceTypeDataTable $spaceTypeDataTable
     * @return Response
     */
    public function index(SpaceTypeDataTable $spaceTypeDataTable)
    {
        return $spaceTypeDataTable->render('space_types.index');
    }

    /**
     * Show the form for creating a new SpaceType.
     *
     * @return Response
     */
    public function create()
    {

         //Se cruza con el modelo de la clave foranea
        $spaces = \App\Models\Space::pluck('name', 'id');
        return view('space_types.create')->with('spaces',$spaces);
    }

    /**
     * Store a newly created SpaceType in storage.
     *
     * @param CreateSpaceTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateSpaceTypeRequest $request)
    {
        $input = $request->all();

        $spaceType = $this->spaceTypeRepository->create($input);

        Flash::success('Space Type saved successfully.');

        return redirect(route('spaceTypes.index'));
    }

    /**
     * Display the specified SpaceType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            Flash::error('Space Type not found');

            return redirect(route('spaceTypes.index'));
        }

        return view('space_types.show')->with('spaceType', $spaceType);
    }

    /**
     * Show the form for editing the specified SpaceType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            Flash::error('Space Type not found');

            return redirect(route('spaceTypes.index'));
        }

        return view('space_types.edit')->with('spaceType', $spaceType);
    }

    /**
     * Update the specified SpaceType in storage.
     *
     * @param  int              $id
     * @param UpdateSpaceTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpaceTypeRequest $request)
    {
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            Flash::error('Space Type not found');

            return redirect(route('spaceTypes.index'));
        }

        $spaceType = $this->spaceTypeRepository->update($request->all(), $id);

        Flash::success('Space Type updated successfully.');

        return redirect(route('spaceTypes.index'));
    }

    /**
     * Remove the specified SpaceType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $spaceType = $this->spaceTypeRepository->findWithoutFail($id);

        if (empty($spaceType)) {
            Flash::error('Space Type not found');

            return redirect(route('spaceTypes.index'));
        }

        $this->spaceTypeRepository->delete($id);

        Flash::success('Space Type deleted successfully.');

        return redirect(route('spaceTypes.index'));
    }
}
