<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MaintainerApiTest extends TestCase
{
    use MakeMaintainerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMaintainer()
    {
        $maintainer = $this->fakeMaintainerData();
        $this->json('POST', '/api/v1/maintainers', $maintainer);

        $this->assertApiResponse($maintainer);
    }

    /**
     * @test
     */
    public function testReadMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $this->json('GET', '/api/v1/maintainers/'.$maintainer->id);

        $this->assertApiResponse($maintainer->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $editedMaintainer = $this->fakeMaintainerData();

        $this->json('PUT', '/api/v1/maintainers/'.$maintainer->id, $editedMaintainer);

        $this->assertApiResponse($editedMaintainer);
    }

    /**
     * @test
     */
    public function testDeleteMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $this->json('DELETE', '/api/v1/maintainers/'.$maintainer->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/maintainers/'.$maintainer->id);

        $this->assertResponseStatus(404);
    }
}
