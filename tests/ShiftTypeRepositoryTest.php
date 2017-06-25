<?php

use App\Models\ShiftType;
use App\Repositories\ShiftTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShiftTypeRepositoryTest extends TestCase
{
    use MakeShiftTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ShiftTypeRepository
     */
    protected $shiftTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->shiftTypeRepo = App::make(ShiftTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateShiftType()
    {
        $shiftType = $this->fakeShiftTypeData();
        $createdShiftType = $this->shiftTypeRepo->create($shiftType);
        $createdShiftType = $createdShiftType->toArray();
        $this->assertArrayHasKey('id', $createdShiftType);
        $this->assertNotNull($createdShiftType['id'], 'Created ShiftType must have id specified');
        $this->assertNotNull(ShiftType::find($createdShiftType['id']), 'ShiftType with given id must be in DB');
        $this->assertModelData($shiftType, $createdShiftType);
    }

    /**
     * @test read
     */
    public function testReadShiftType()
    {
        $shiftType = $this->makeShiftType();
        $dbShiftType = $this->shiftTypeRepo->find($shiftType->id);
        $dbShiftType = $dbShiftType->toArray();
        $this->assertModelData($shiftType->toArray(), $dbShiftType);
    }

    /**
     * @test update
     */
    public function testUpdateShiftType()
    {
        $shiftType = $this->makeShiftType();
        $fakeShiftType = $this->fakeShiftTypeData();
        $updatedShiftType = $this->shiftTypeRepo->update($fakeShiftType, $shiftType->id);
        $this->assertModelData($fakeShiftType, $updatedShiftType->toArray());
        $dbShiftType = $this->shiftTypeRepo->find($shiftType->id);
        $this->assertModelData($fakeShiftType, $dbShiftType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteShiftType()
    {
        $shiftType = $this->makeShiftType();
        $resp = $this->shiftTypeRepo->delete($shiftType->id);
        $this->assertTrue($resp);
        $this->assertNull(ShiftType::find($shiftType->id), 'ShiftType should not exist in DB');
    }
}
