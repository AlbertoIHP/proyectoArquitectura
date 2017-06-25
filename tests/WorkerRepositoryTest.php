<?php

use App\Models\Worker;
use App\Repositories\WorkerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkerRepositoryTest extends TestCase
{
    use MakeWorkerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var WorkerRepository
     */
    protected $workerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->workerRepo = App::make(WorkerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateWorker()
    {
        $worker = $this->fakeWorkerData();
        $createdWorker = $this->workerRepo->create($worker);
        $createdWorker = $createdWorker->toArray();
        $this->assertArrayHasKey('id', $createdWorker);
        $this->assertNotNull($createdWorker['id'], 'Created Worker must have id specified');
        $this->assertNotNull(Worker::find($createdWorker['id']), 'Worker with given id must be in DB');
        $this->assertModelData($worker, $createdWorker);
    }

    /**
     * @test read
     */
    public function testReadWorker()
    {
        $worker = $this->makeWorker();
        $dbWorker = $this->workerRepo->find($worker->id);
        $dbWorker = $dbWorker->toArray();
        $this->assertModelData($worker->toArray(), $dbWorker);
    }

    /**
     * @test update
     */
    public function testUpdateWorker()
    {
        $worker = $this->makeWorker();
        $fakeWorker = $this->fakeWorkerData();
        $updatedWorker = $this->workerRepo->update($fakeWorker, $worker->id);
        $this->assertModelData($fakeWorker, $updatedWorker->toArray());
        $dbWorker = $this->workerRepo->find($worker->id);
        $this->assertModelData($fakeWorker, $dbWorker->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteWorker()
    {
        $worker = $this->makeWorker();
        $resp = $this->workerRepo->delete($worker->id);
        $this->assertTrue($resp);
        $this->assertNull(Worker::find($worker->id), 'Worker should not exist in DB');
    }
}
