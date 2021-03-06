<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Repositories\ExpenseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExpenseController extends AppBaseController
{
    /** @var  ExpenseRepository */
    private $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepo)
    {
        $this->expenseRepository = $expenseRepo;
    }

    /**
     * Display a listing of the Expense.
     *
     * @param ExpenseDataTable $expenseDataTable
     * @return Response
     */
    public function index(ExpenseDataTable $expenseDataTable)
    {
        return $expenseDataTable->render('expenses.index');
    }

    /**
     * Show the form for creating a new Expense.
     *
     * @return Response
     */
    public function create()
    {

         //Se cruza con el modelo de la clave foranea
        $buildings = \App\Models\Building::pluck('name', 'id');
        return view('expenses.create')->with('buildings',$buildings);
    }

    /**
     * Store a newly created Expense in storage.
     *
     * @param CreateExpenseRequest $request
     *
     * @return Response
     */
    public function store(CreateExpenseRequest $request)
    {
        $input = $request->all();

        $expense = $this->expenseRepository->create($input);

        Flash::success('Expense saved successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Display the specified Expense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $expense = $this->expenseRepository->findWithoutFail($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.show')->with('expense', $expense);
    }

    /**
     * Show the form for editing the specified Expense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $expense = $this->expenseRepository->findWithoutFail($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        return view('expenses.edit')->with('expense', $expense);
    }

    /**
     * Update the specified Expense in storage.
     *
     * @param  int              $id
     * @param UpdateExpenseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExpenseRequest $request)
    {
        $expense = $this->expenseRepository->findWithoutFail($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        $expense = $this->expenseRepository->update($request->all(), $id);

        Flash::success('Expense updated successfully.');

        return redirect(route('expenses.index'));
    }

    /**
     * Remove the specified Expense from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $expense = $this->expenseRepository->findWithoutFail($id);

        if (empty($expense)) {
            Flash::error('Expense not found');

            return redirect(route('expenses.index'));
        }

        $this->expenseRepository->delete($id);

        Flash::success('Expense deleted successfully.');

        return redirect(route('expenses.index'));
    }
}
