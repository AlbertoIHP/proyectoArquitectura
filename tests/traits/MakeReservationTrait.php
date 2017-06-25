<?php

use Faker\Factory as Faker;
use App\Models\Reservation;
use App\Repositories\ReservationRepository;

trait MakeReservationTrait
{
    /**
     * Create fake instance of Reservation and save it in database
     *
     * @param array $reservationFields
     * @return Reservation
     */
    public function makeReservation($reservationFields = [])
    {
        /** @var ReservationRepository $reservationRepo */
        $reservationRepo = App::make(ReservationRepository::class);
        $theme = $this->fakeReservationData($reservationFields);
        return $reservationRepo->create($theme);
    }

    /**
     * Get fake instance of Reservation
     *
     * @param array $reservationFields
     * @return Reservation
     */
    public function fakeReservation($reservationFields = [])
    {
        return new Reservation($this->fakeReservationData($reservationFields));
    }

    /**
     * Get fake data of Reservation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeReservationData($reservationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'space_id' => $fake->randomDigitNotNull,
            'fecha' => $fake->word,
            'pagado' => $fake->word,
            'cliente' => $fake->word
        ], $reservationFields);
    }
}
