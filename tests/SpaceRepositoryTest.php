<?php

use App\Models\Space;
use App\Repositories\SpaceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpaceRepositoryTest extends TestCase
{
    use MakeSpaceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpaceRepository
     */
    protected $spaceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->spaceRepo = App::make(SpaceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSpace()
    {
        $space = $this->fakeSpaceData();
        $createdSpace = $this->spaceRepo->create($space);
        $createdSpace = $createdSpace->toArray();
        $this->assertArrayHasKey('id', $createdSpace);
        $this->assertNotNull($createdSpace['id'], 'Created Space must have id specified');
        $this->assertNotNull(Space::find($createdSpace['id']), 'Space with given id must be in DB');
        $this->assertModelData($space, $createdSpace);
    }

    /**
     * @test read
     */
    public function testReadSpace()
    {
        $space = $this->makeSpace();
        $dbSpace = $this->spaceRepo->find($space->id);
        $dbSpace = $dbSpace->toArray();
        $this->assertModelData($space->toArray(), $dbSpace);
    }

    /**
     * @test update
     */
    public function testUpdateSpace()
    {
        $space = $this->makeSpace();
        $fakeSpace = $this->fakeSpaceData();
        $updatedSpace = $this->spaceRepo->update($fakeSpace, $space->id);
        $this->assertModelData($fakeSpace, $updatedSpace->toArray());
        $dbSpace = $this->spaceRepo->find($space->id);
        $this->assertModelData($fakeSpace, $dbSpace->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSpace()
    {
        $space = $this->makeSpace();
        $resp = $this->spaceRepo->delete($space->id);
        $this->assertTrue($resp);
        $this->assertNull(Space::find($space->id), 'Space should not exist in DB');
    }
}
