<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShiftTypeApiTest extends TestCase
{
    use MakeShiftTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateShiftType()
    {
        $shiftType = $this->fakeShiftTypeData();
        $this->json('POST', '/api/v1/shiftTypes', $shiftType);

        $this->assertApiResponse($shiftType);
    }

    /**
     * @test
     */
    public function testReadShiftType()
    {
        $shiftType = $this->makeShiftType();
        $this->json('GET', '/api/v1/shiftTypes/'.$shiftType->id);

        $this->assertApiResponse($shiftType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateShiftType()
    {
        $shiftType = $this->makeShiftType();
        $editedShiftType = $this->fakeShiftTypeData();

        $this->json('PUT', '/api/v1/shiftTypes/'.$shiftType->id, $editedShiftType);

        $this->assertApiResponse($editedShiftType);
    }

    /**
     * @test
     */
    public function testDeleteShiftType()
    {
        $shiftType = $this->makeShiftType();
        $this->json('DELETE', '/api/v1/shiftTypes/'.$shiftType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/shiftTypes/'.$shiftType->id);

        $this->assertResponseStatus(404);
    }
}
