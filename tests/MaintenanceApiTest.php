<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MaintenanceApiTest extends TestCase
{
    use MakeMaintenanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMaintenance()
    {
        $maintenance = $this->fakeMaintenanceData();
        $this->json('POST', '/api/v1/maintenances', $maintenance);

        $this->assertApiResponse($maintenance);
    }

    /**
     * @test
     */
    public function testReadMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $this->json('GET', '/api/v1/maintenances/'.$maintenance->id);

        $this->assertApiResponse($maintenance->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $editedMaintenance = $this->fakeMaintenanceData();

        $this->json('PUT', '/api/v1/maintenances/'.$maintenance->id, $editedMaintenance);

        $this->assertApiResponse($editedMaintenance);
    }

    /**
     * @test
     */
    public function testDeleteMaintenance()
    {
        $maintenance = $this->makeMaintenance();
        $this->json('DELETE', '/api/v1/maintenances/'.$maintenance->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/maintenances/'.$maintenance->id);

        $this->assertResponseStatus(404);
    }
}
