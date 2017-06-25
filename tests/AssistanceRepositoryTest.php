<?php

use App\Models\Assistance;
use App\Repositories\AssistanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssistanceRepositoryTest extends TestCase
{
    use MakeAssistanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssistanceRepository
     */
    protected $assistanceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->assistanceRepo = App::make(AssistanceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateAssistance()
    {
        $assistance = $this->fakeAssistanceData();
        $createdAssistance = $this->assistanceRepo->create($assistance);
        $createdAssistance = $createdAssistance->toArray();
        $this->assertArrayHasKey('id', $createdAssistance);
        $this->assertNotNull($createdAssistance['id'], 'Created Assistance must have id specified');
        $this->assertNotNull(Assistance::find($createdAssistance['id']), 'Assistance with given id must be in DB');
        $this->assertModelData($assistance, $createdAssistance);
    }

    /**
     * @test read
     */
    public function testReadAssistance()
    {
        $assistance = $this->makeAssistance();
        $dbAssistance = $this->assistanceRepo->find($assistance->id);
        $dbAssistance = $dbAssistance->toArray();
        $this->assertModelData($assistance->toArray(), $dbAssistance);
    }

    /**
     * @test update
     */
    public function testUpdateAssistance()
    {
        $assistance = $this->makeAssistance();
        $fakeAssistance = $this->fakeAssistanceData();
        $updatedAssistance = $this->assistanceRepo->update($fakeAssistance, $assistance->id);
        $this->assertModelData($fakeAssistance, $updatedAssistance->toArray());
        $dbAssistance = $this->assistanceRepo->find($assistance->id);
        $this->assertModelData($fakeAssistance, $dbAssistance->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteAssistance()
    {
        $assistance = $this->makeAssistance();
        $resp = $this->assistanceRepo->delete($assistance->id);
        $this->assertTrue($resp);
        $this->assertNull(Assistance::find($assistance->id), 'Assistance should not exist in DB');
    }
}
