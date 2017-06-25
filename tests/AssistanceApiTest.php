<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssistanceApiTest extends TestCase
{
    use MakeAssistanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateAssistance()
    {
        $assistance = $this->fakeAssistanceData();
        $this->json('POST', '/api/v1/assistances', $assistance);

        $this->assertApiResponse($assistance);
    }

    /**
     * @test
     */
    public function testReadAssistance()
    {
        $assistance = $this->makeAssistance();
        $this->json('GET', '/api/v1/assistances/'.$assistance->id);

        $this->assertApiResponse($assistance->toArray());
    }

    /**
     * @test
     */
    public function testUpdateAssistance()
    {
        $assistance = $this->makeAssistance();
        $editedAssistance = $this->fakeAssistanceData();

        $this->json('PUT', '/api/v1/assistances/'.$assistance->id, $editedAssistance);

        $this->assertApiResponse($editedAssistance);
    }

    /**
     * @test
     */
    public function testDeleteAssistance()
    {
        $assistance = $this->makeAssistance();
        $this->json('DELETE', '/api/v1/assistances/'.$assistance->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/assistances/'.$assistance->id);

        $this->assertResponseStatus(404);
    }
}
