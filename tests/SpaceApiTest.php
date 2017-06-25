<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpaceApiTest extends TestCase
{
    use MakeSpaceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSpace()
    {
        $space = $this->fakeSpaceData();
        $this->json('POST', '/api/v1/spaces', $space);

        $this->assertApiResponse($space);
    }

    /**
     * @test
     */
    public function testReadSpace()
    {
        $space = $this->makeSpace();
        $this->json('GET', '/api/v1/spaces/'.$space->id);

        $this->assertApiResponse($space->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSpace()
    {
        $space = $this->makeSpace();
        $editedSpace = $this->fakeSpaceData();

        $this->json('PUT', '/api/v1/spaces/'.$space->id, $editedSpace);

        $this->assertApiResponse($editedSpace);
    }

    /**
     * @test
     */
    public function testDeleteSpace()
    {
        $space = $this->makeSpace();
        $this->json('DELETE', '/api/v1/spaces/'.$space->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/spaces/'.$space->id);

        $this->assertResponseStatus(404);
    }
}
