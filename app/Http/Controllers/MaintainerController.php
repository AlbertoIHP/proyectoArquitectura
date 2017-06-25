<?php

namespace App\Http\Controllers;

use App\DataTables\MaintainerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMaintainerRequest;
use App\Http\Requests\UpdateMaintainerRequest;
use App\Repositories\MaintainerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MaintainerController extends AppBaseController
{
    /** @var  MaintainerRepository */
    private $maintainerRepository;

    public function __construct(MaintainerRepository $maintainerRepo)
    {
        $this->maintainerRepository = $maintainerRepo;
    }

    /**
     * Display a listing of the Maintainer.
     *
     * @param MaintainerDataTable $maintainerDataTable
     * @return Response
     */
    public function index(MaintainerDataTable $maintainerDataTable)
    {
        return $maintainerDataTable->render('maintainers.index');
    }

    /**
     * Show the form for creating a new Maintainer.
     *
     * @return Response
     */
    public function create()
    {
        return view('maintainers.create');
    }

    /**
     * Store a newly created Maintainer in storage.
     *
     * @param CreateMaintainerRequest $request
     *
     * @return Response
     */
    public function store(CreateMaintainerRequest $request)
    {
        $input = $request->all();

        $maintainer = $this->maintainerRepository->create($input);

        Flash::success('Maintainer saved successfully.');

        return redirect(route('maintainers.index'));
    }

    /**
     * Display the specified Maintainer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            Flash::error('Maintainer not found');

            return redirect(route('maintainers.index'));
        }

        return view('maintainers.show')->with('maintainer', $maintainer);
    }

    /**
     * Show the form for editing the specified Maintainer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            Flash::error('Maintainer not found');

            return redirect(route('maintainers.index'));
        }

        return view('maintainers.edit')->with('maintainer', $maintainer);
    }

    /**
     * Update the specified Maintainer in storage.
     *
     * @param  int              $id
     * @param UpdateMaintainerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaintainerRequest $request)
    {
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            Flash::error('Maintainer not found');

            return redirect(route('maintainers.index'));
        }

        $maintainer = $this->maintainerRepository->update($request->all(), $id);

        Flash::success('Maintainer updated successfully.');

        return redirect(route('maintainers.index'));
    }

    /**
     * Remove the specified Maintainer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $maintainer = $this->maintainerRepository->findWithoutFail($id);

        if (empty($maintainer)) {
            Flash::error('Maintainer not found');

            return redirect(route('maintainers.index'));
        }

        $this->maintainerRepository->delete($id);

        Flash::success('Maintainer deleted successfully.');

        return redirect(route('maintainers.index'));
    }
}
