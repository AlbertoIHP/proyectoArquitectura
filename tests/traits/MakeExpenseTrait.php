<?php

use Faker\Factory as Faker;
use App\Models\Expense;
use App\Repositories\ExpenseRepository;

trait MakeExpenseTrait
{
    /**
     * Create fake instance of Expense and save it in database
     *
     * @param array $expenseFields
     * @return Expense
     */
    public function makeExpense($expenseFields = [])
    {
        /** @var ExpenseRepository $expenseRepo */
        $expenseRepo = App::make(ExpenseRepository::class);
        $theme = $this->fakeExpenseData($expenseFields);
        return $expenseRepo->create($theme);
    }

    /**
     * Get fake instance of Expense
     *
     * @param array $expenseFields
     * @return Expense
     */
    public function fakeExpense($expenseFields = [])
    {
        return new Expense($this->fakeExpenseData($expenseFields));
    }

    /**
     * Get fake data of Expense
     *
     * @param array $postFields
     * @return array
     */
    public function fakeExpenseData($expenseFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'building_id' => $fake->randomDigitNotNull,
            'monto' => $fake->randomDigitNotNull,
            'mes' => $fake->randomDigitNotNull,
            'anio' => $fake->randomDigitNotNull,
            'descripcion' => $fake->word
        ], $expenseFields);
    }
}
