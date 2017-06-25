<?php

use App\Models\Maintainer;
use App\Repositories\MaintainerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MaintainerRepositoryTest extends TestCase
{
    use MakeMaintainerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MaintainerRepository
     */
    protected $maintainerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->maintainerRepo = App::make(MaintainerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMaintainer()
    {
        $maintainer = $this->fakeMaintainerData();
        $createdMaintainer = $this->maintainerRepo->create($maintainer);
        $createdMaintainer = $createdMaintainer->toArray();
        $this->assertArrayHasKey('id', $createdMaintainer);
        $this->assertNotNull($createdMaintainer['id'], 'Created Maintainer must have id specified');
        $this->assertNotNull(Maintainer::find($createdMaintainer['id']), 'Maintainer with given id must be in DB');
        $this->assertModelData($maintainer, $createdMaintainer);
    }

    /**
     * @test read
     */
    public function testReadMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $dbMaintainer = $this->maintainerRepo->find($maintainer->id);
        $dbMaintainer = $dbMaintainer->toArray();
        $this->assertModelData($maintainer->toArray(), $dbMaintainer);
    }

    /**
     * @test update
     */
    public function testUpdateMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $fakeMaintainer = $this->fakeMaintainerData();
        $updatedMaintainer = $this->maintainerRepo->update($fakeMaintainer, $maintainer->id);
        $this->assertModelData($fakeMaintainer, $updatedMaintainer->toArray());
        $dbMaintainer = $this->maintainerRepo->find($maintainer->id);
        $this->assertModelData($fakeMaintainer, $dbMaintainer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMaintainer()
    {
        $maintainer = $this->makeMaintainer();
        $resp = $this->maintainerRepo->delete($maintainer->id);
        $this->assertTrue($resp);
        $this->assertNull(Maintainer::find($maintainer->id), 'Maintainer should not exist in DB');
    }
}
