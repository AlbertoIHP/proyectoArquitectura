<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalendarApiTest extends TestCase
{
    use MakeCalendarTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCalendar()
    {
        $calendar = $this->fakeCalendarData();
        $this->json('POST', '/api/v1/calendars', $calendar);

        $this->assertApiResponse($calendar);
    }

    /**
     * @test
     */
    public function testReadCalendar()
    {
        $calendar = $this->makeCalendar();
        $this->json('GET', '/api/v1/calendars/'.$calendar->id);

        $this->assertApiResponse($calendar->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCalendar()
    {
        $calendar = $this->makeCalendar();
        $editedCalendar = $this->fakeCalendarData();

        $this->json('PUT', '/api/v1/calendars/'.$calendar->id, $editedCalendar);

        $this->assertApiResponse($editedCalendar);
    }

    /**
     * @test
     */
    public function testDeleteCalendar()
    {
        $calendar = $this->makeCalendar();
        $this->json('DELETE', '/api/v1/calendars/'.$calendar->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/calendars/'.$calendar->id);

        $this->assertResponseStatus(404);
    }
}
