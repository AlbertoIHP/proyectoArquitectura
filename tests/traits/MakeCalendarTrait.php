<?php

use Faker\Factory as Faker;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;

trait MakeCalendarTrait
{
    /**
     * Create fake instance of Calendar and save it in database
     *
     * @param array $calendarFields
     * @return Calendar
     */
    public function makeCalendar($calendarFields = [])
    {
        /** @var CalendarRepository $calendarRepo */
        $calendarRepo = App::make(CalendarRepository::class);
        $theme = $this->fakeCalendarData($calendarFields);
        return $calendarRepo->create($theme);
    }

    /**
     * Get fake instance of Calendar
     *
     * @param array $calendarFields
     * @return Calendar
     */
    public function fakeCalendar($calendarFields = [])
    {
        return new Calendar($this->fakeCalendarData($calendarFields));
    }

    /**
     * Get fake data of Calendar
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCalendarData($calendarFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'building_id' => $fake->randomDigitNotNull
        ], $calendarFields);
    }
}
