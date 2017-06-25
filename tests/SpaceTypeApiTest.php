<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SpaceTypeApiTest extends TestCase
{
    use MakeSpaceTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSpaceType()
    {
        $spaceType = $this->fakeSpaceTypeData();
        $this->json('POST', '/api/v1/spaceTypes', $spaceType);

        $this->assertApiResponse($spaceType);
    }

    /**
     * @test
     */
    public function testReadSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $this->json('GET', '/api/v1/spaceTypes/'.$spaceType->id);

        $this->assertApiResponse($spaceType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $editedSpaceType = $this->fakeSpaceTypeData();

        $this->json('PUT', '/api/v1/spaceTypes/'.$spaceType->id, $editedSpaceType);

        $this->assertApiResponse($editedSpaceType);
    }

    /**
     * @test
     */
    public function testDeleteSpaceType()
    {
        $spaceType = $this->makeSpaceType();
        $this->json('DELETE', '/api/v1/spaceTypes/'.$spaceType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/spaceTypes/'.$spaceType->id);

        $this->assertResponseStatus(404);
    }
}
