<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkerApiTest extends TestCase
{
    use MakeWorkerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateWorker()
    {
        $worker = $this->fakeWorkerData();
        $this->json('POST', '/api/v1/workers', $worker);

        $this->assertApiResponse($worker);
    }

    /**
     * @test
     */
    public function testReadWorker()
    {
        $worker = $this->makeWorker();
        $this->json('GET', '/api/v1/workers/'.$worker->id);

        $this->assertApiResponse($worker->toArray());
    }

    /**
     * @test
     */
    public function testUpdateWorker()
    {
        $worker = $this->makeWorker();
        $editedWorker = $this->fakeWorkerData();

        $this->json('PUT', '/api/v1/workers/'.$worker->id, $editedWorker);

        $this->assertApiResponse($editedWorker);
    }

    /**
     * @test
     */
    public function testDeleteWorker()
    {
        $worker = $this->makeWorker();
        $this->json('DELETE', '/api/v1/workers/'.$worker->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/workers/'.$worker->id);

        $this->assertResponseStatus(404);
    }
}
