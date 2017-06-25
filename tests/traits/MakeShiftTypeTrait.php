<?php

use Faker\Factory as Faker;
use App\Models\ShiftType;
use App\Repositories\ShiftTypeRepository;

trait MakeShiftTypeTrait
{
    /**
     * Create fake instance of ShiftType and save it in database
     *
     * @param array $shiftTypeFields
     * @return ShiftType
     */
    public function makeShiftType($shiftTypeFields = [])
    {
        /** @var ShiftTypeRepository $shiftTypeRepo */
        $shiftTypeRepo = App::make(ShiftTypeRepository::class);
        $theme = $this->fakeShiftTypeData($shiftTypeFields);
        return $shiftTypeRepo->create($theme);
    }

    /**
     * Get fake instance of ShiftType
     *
     * @param array $shiftTypeFields
     * @return ShiftType
     */
    public function fakeShiftType($shiftTypeFields = [])
    {
        return new ShiftType($this->fakeShiftTypeData($shiftTypeFields));
    }

    /**
     * Get fake data of ShiftType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeShiftTypeData($shiftTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word
        ], $shiftTypeFields);
    }
}
