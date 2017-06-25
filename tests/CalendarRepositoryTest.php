<?php

use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalendarRepositoryTest extends TestCase
{
    use MakeCalendarTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CalendarRepository
     */
    protected $calendarRepo;

    public function setUp()
    {
        parent::setUp();
        $this->calendarRepo = App::make(CalendarRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCalendar()
    {
        $calendar = $this->fakeCalendarData();
        $createdCalendar = $this->calendarRepo->create($calendar);
        $createdCalendar = $createdCalendar->toArray();
        $this->assertArrayHasKey('id', $createdCalendar);
        $this->assertNotNull($createdCalendar['id'], 'Created Calendar must have id specified');
        $this->assertNotNull(Calendar::find($createdCalendar['id']), 'Calendar with given id must be in DB');
        $this->assertModelData($calendar, $createdCalendar);
    }

    /**
     * @test read
     */
    public function testReadCalendar()
    {
        $calendar = $this->makeCalendar();
        $dbCalendar = $this->calendarRepo->find($calendar->id);
        $dbCalendar = $dbCalendar->toArray();
        $this->assertModelData($calendar->toArray(), $dbCalendar);
    }

    /**
     * @test update
     */
    public function testUpdateCalendar()
    {
        $calendar = $this->makeCalendar();
        $fakeCalendar = $this->fakeCalendarData();
        $updatedCalendar = $this->calendarRepo->update($fakeCalendar, $calendar->id);
        $this->assertModelData($fakeCalendar, $updatedCalendar->toArray());
        $dbCalendar = $this->calendarRepo->find($calendar->id);
        $this->assertModelData($fakeCalendar, $dbCalendar->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCalendar()
    {
        $calendar = $this->makeCalendar();
        $resp = $this->calendarRepo->delete($calendar->id);
        $this->assertTrue($resp);
        $this->assertNull(Calendar::find($calendar->id), 'Calendar should not exist in DB');
    }
}
