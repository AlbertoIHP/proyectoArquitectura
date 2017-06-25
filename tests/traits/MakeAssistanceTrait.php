<?php

use Faker\Factory as Faker;
use App\Models\Assistance;
use App\Repositories\AssistanceRepository;

trait MakeAssistanceTrait
{
    /**
     * Create fake instance of Assistance and save it in database
     *
     * @param array $assistanceFields
     * @return Assistance
     */
    public function makeAssistance($assistanceFields = [])
    {
        /** @var AssistanceRepository $assistanceRepo */
        $assistanceRepo = App::make(AssistanceRepository::class);
        $theme = $this->fakeAssistanceData($assistanceFields);
        return $assistanceRepo->create($theme);
    }

    /**
     * Get fake instance of Assistance
     *
     * @param array $assistanceFields
     * @return Assistance
     */
    public function fakeAssistance($assistanceFields = [])
    {
        return new Assistance($this->fakeAssistanceData($assistanceFields));
    }

    /**
     * Get fake data of Assistance
     *
     * @param array $postFields
     * @return array
     */
    public function fakeAssistanceData($assistanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'fecha' => $fake->word,
            'hora_entrada' => $fake->randomDigitNotNull,
            'reemplazo' => $fake->word,
            'worker_id' => $fake->randomDigitNotNull
        ], $assistanceFields);
    }
}
