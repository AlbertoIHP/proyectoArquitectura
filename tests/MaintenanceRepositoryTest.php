<?php

use App\Models\Maintenance;
use App\Repositories\MaintenanceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MaintenanceRepositoryTest extends TestCase
{
    use MakeMaintenanceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MaintenanceRepository
     */
    protected $maintenanceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->maintenanceRepo = App::make(MaintenanceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMaintenance()
    {
        $maintenance = $this->fakeMaintenanceData();
        $createdMaintenance = $this->maintenanceRepo->create($maintenance);
        $createdMaintenance = $createdMaintenance->toArray();
        $this->assertArrayHasKey('id', $createdMaintenance);
        $this->assertNotNull($createdMaintenance['id'], 'Created Maintenance must have id specified');
        $this->assertNotNull(Maintenance::find($createdMaintenance['id']), 'Maintenance with given id must be in DB');
        $this->assertModelData($maintenance, $createdMaintenance);
    }

    /**
     * @test read
     */
    public function testReadMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $dbMaintenance = $this->maintenanceRepo->find($maintenance->id);
        $dbMaintenance = $dbMaintenance->toArray();
        $this->assertModelData($maintenance->toArray(), $dbMaintenance);
    }

    /**
     * @test update
     */
    public function testUpdateMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $fakeMaintenance = $this->fakeMaintenanceData();
        $updatedMaintenance = $this->maintenanceRepo->update($fakeMaintenance, $maintenance->id);
        $this->assertModelData($fakeMaintenance, $updatedMaintenance->toArray());
        $dbMaintenance = $this->maintenanceRepo->find($maintenance->id);
        $this->assertModelData($fakeMaintenance, $dbMaintenance->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $resp = $this->maintenanceRepo->delete($maintenance->id);
        $this->assertTrue($resp);
        $this->assertNull(Maintenance::find($maintenance->id), 'Maintenance should not exist in DB');
    }
}
