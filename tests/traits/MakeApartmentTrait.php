<?php

use Faker\Factory as Faker;
use App\Models\Apartment;
use App\Repositories\ApartmentRepository;

trait MakeApartmentTrait
{
    /**
     * Create fake instance of Apartment and save it in database
     *
     * @param array $apartmentFields
     * @return Apartment
     */
    public function makeApartment($apartmentFields = [])
    {
        /** @var ApartmentRepository $apartmentRepo */
        $apartmentRepo = App::make(ApartmentRepository::class);
        $theme = $this->fakeApartmentData($apartmentFields);
        return $apartmentRepo->create($theme);
    }

    /**
     * Get fake instance of Apartment
     *
     * @param array $apartmentFields
     * @return Apartment
     */
    public function fakeApartment($apartmentFields = [])
    {
        return new Apartment($this->fakeApartmentData($apartmentFields));
    }

    /**
     * Get fake data of Apartment
     *
     * @param array $postFields
     * @return array
     */
    public function fakeApartmentData($apartmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'building_id' => $fake->randomDigitNotNull,
            'numero' => $fake->randomDigitNotNull,
            'area' => $fake->randomDigitNotNull
        ], $apartmentFields);
    }
}
