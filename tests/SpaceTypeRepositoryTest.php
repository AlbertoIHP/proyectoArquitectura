<?php

use App\Models\SpaceType;
use App\Repositories\SpaceTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpaceTypeRepositoryTest extends TestCase
{
    use MakeSpaceTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpaceTypeRepository
     */
    protected $spaceTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->spaceTypeRepo = App::make(SpaceTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSpaceType()
    {
        $spaceType = $this->fakeSpaceTypeData();
        $createdSpaceType = $this->spaceTypeRepo->create($spaceType);
        $createdSpaceType = $createdSpaceType->toArray();
        $this->assertArrayHasKey('id', $createdSpaceType);
        $this->assertNotNull($createdSpaceType['id'], 'Created SpaceType must have id specified');
        $this->assertNotNull(SpaceType::find($createdSpaceType['id']), 'SpaceType with given id must be in DB');
        $this->assertModelData($spaceType, $createdSpaceType);
    }

    /**
     * @test read
     */
    public function testReadSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $dbSpaceType = $this->spaceTypeRepo->find($spaceType->id);
        $dbSpaceType = $dbSpaceType->toArray();
        $this->assertModelData($spaceType->toArray(), $dbSpaceType);
    }

    /**
     * @test update
     */
    public function testUpdateSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $fakeSpaceType = $this->fakeSpaceTypeData();
        $updatedSpaceType = $this->spaceTypeRepo->update($fakeSpaceType, $spaceType->id);
        $this->assertModelData($fakeSpaceType, $updatedSpaceType->toArray());
        $dbSpaceType = $this->spaceTypeRepo->find($spaceType->id);
        $this->assertModelData($fakeSpaceType, $dbSpaceType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $resp = $this->spaceTypeRepo->delete($spaceType->id);
        $this->assertTrue($resp);
        $this->assertNull(SpaceType::find($spaceType->id), 'SpaceType should not exist in DB');
    }
}
