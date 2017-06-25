<?php

namespace App\Http\Controllers;

use App\DataTables\SpaceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSpaceRequest;
use App\Http\Requests\UpdateSpaceRequest;
use App\Repositories\SpaceRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SpaceController extends AppBaseController
{
    /** @var  SpaceRepository */
    private $spaceRepository;

    public function __construct(SpaceRepository $spaceRepo)
    {
        $this->spaceRepository = $spaceRepo;
    }

    /**
     * Display a listing of the Space.
     *
     * @param SpaceDataTable $spaceDataTable
     * @return Response
     */
    public function index(SpaceDataTable $spaceDataTable)
    {
        return $spaceDataTable->render('spaces.index');
    }

    /**
     * Show the form for creating a new Space.
     *
     * @return Response
     */
    public function create()
    {


         //Se cruza con el modelo de la clave foranea
        $buildings = \App\Models\Building::pluck('name', 'id');
        return view('spaces.create')->with('buildings',$buildings);
    }

    /**
     * Store a newly created Space in storage.
     *
     * @param CreateSpaceRequest $request
     *
     * @return Response
     */
    public function store(CreateSpaceRequest $request)
    {
        $input = $request->all();

        $space = $this->spaceRepository->create($input);

        Flash::success('Space saved successfully.');

        return redirect(route('spaces.index'));
    }

    /**
     * Display the specified Space.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            Flash::error('Space not found');

            return redirect(route('spaces.index'));
        }

        return view('spaces.show')->with('space', $space);
    }

    /**
     * Show the form for editing the specified Space.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            Flash::error('Space not found');

            return redirect(route('spaces.index'));
        }

        return view('spaces.edit')->with('space', $space);
    }

    /**
     * Update the specified Space in storage.
     *
     * @param  int              $id
     * @param UpdateSpaceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpaceRequest $request)
    {
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            Flash::error('Space not found');

            return redirect(route('spaces.index'));
        }

        $space = $this->spaceRepository->update($request->all(), $id);

        Flash::success('Space updated successfully.');

        return redirect(route('spaces.index'));
    }

    /**
     * Remove the specified Space from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $space = $this->spaceRepository->findWithoutFail($id);

        if (empty($space)) {
            Flash::error('Space not found');

            return redirect(route('spaces.index'));
        }

        $this->spaceRepository->delete($id);

        Flash::success('Space deleted successfully.');

        return redirect(route('spaces.index'));
    }
}
