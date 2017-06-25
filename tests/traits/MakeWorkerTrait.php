<?php

use Faker\Factory as Faker;
use App\Models\Worker;
use App\Repositories\WorkerRepository;

trait MakeWorkerTrait
{
    /**
     * Create fake instance of Worker and save it in database
     *
     * @param array $workerFields
     * @return Worker
     */
    public function makeWorker($workerFields = [])
    {
        /** @var WorkerRepository $workerRepo */
        $workerRepo = App::make(WorkerRepository::class);
        $theme = $this->fakeWorkerData($workerFields);
        return $workerRepo->create($theme);
    }

    /**
     * Get fake instance of Worker
     *
     * @param array $workerFields
     * @return Worker
     */
    public function fakeWorker($workerFields = [])
    {
        return new Worker($this->fakeWorkerData($workerFields));
    }

    /**
     * Get fake data of Worker
     *
     * @param array $postFields
     * @return array
     */
    public function fakeWorkerData($workerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'user_id' => $fake->randomDigitNotNull,
            'shifttype_id' => $fake->randomDigitNotNull
        ], $workerFields);
    }
}
