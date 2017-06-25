<?php

namespace App\Http\Controllers;

use App\DataTables\ApartmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Repositories\ApartmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ApartmentController extends AppBaseController
{
    /** @var  ApartmentRepository */
    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepo)
    {
        $this->apartmentRepository = $apartmentRepo;
    }

    /**
     * Display a listing of the Apartment.
     *
     * @param ApartmentDataTable $apartmentDataTable
     * @return Response
     */
    public function index(ApartmentDataTable $apartmentDataTable)
    {
        return $apartmentDataTable->render('apartments.index');
    }

    /**
     * Show the form for creating a new Apartment.
     *
     * @return Response
     */
    public function create()
    {

        //Se cruza con el modelo de la clave foranea
        $buildings = \App\Models\Building::pluck('name', 'id');
        return view('apartments.create')->with('buildings',$buildings);



    }

    /**
     * Store a newly created Apartment in storage.
     *
     * @param CreateApartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateApartmentRequest $request)
    {
        $input = $request->all();

        $apartment = $this->apartmentRepository->create($input);

        Flash::success('Apartment saved successfully.');

        return redirect(route('apartments.index'));
    }

    /**
     * Display the specified Apartment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            Flash::error('Apartment not found');

            return redirect(route('apartments.index'));
        }

        return view('apartments.show')->with('apartment', $apartment);
    }

    /**
     * Show the form for editing the specified Apartment.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            Flash::error('Apartment not found');

            return redirect(route('apartments.index'));
        }

        return view('apartments.edit')->with('apartment', $apartment);
    }

    /**
     * Update the specified Apartment in storage.
     *
     * @param  int              $id
     * @param UpdateApartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApartmentRequest $request)
    {
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            Flash::error('Apartment not found');

            return redirect(route('apartments.index'));
        }

        $apartment = $this->apartmentRepository->update($request->all(), $id);

        Flash::success('Apartment updated successfully.');

        return redirect(route('apartments.index'));
    }

    /**
     * Remove the specified Apartment from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $apartment = $this->apartmentRepository->findWithoutFail($id);

        if (empty($apartment)) {
            Flash::error('Apartment not found');

            return redirect(route('apartments.index'));
        }

        $this->apartmentRepository->delete($id);

        Flash::success('Apartment deleted successfully.');

        return redirect(route('apartments.index'));
    }
}
