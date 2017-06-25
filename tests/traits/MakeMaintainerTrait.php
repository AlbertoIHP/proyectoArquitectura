<?php

use Faker\Factory as Faker;
use App\Models\Maintainer;
use App\Repositories\MaintainerRepository;

trait MakeMaintainerTrait
{
    /**
     * Create fake instance of Maintainer and save it in database
     *
     * @param array $maintainerFields
     * @return Maintainer
     */
    public function makeMaintainer($maintainerFields = [])
    {
        /** @var MaintainerRepository $maintainerRepo */
        $maintainerRepo = App::make(MaintainerRepository::class);
        $theme = $this->fakeMaintainerData($maintainerFields);
        return $maintainerRepo->create($theme);
    }

    /**
     * Get fake instance of Maintainer
     *
     * @param array $maintainerFields
     * @return Maintainer
     */
    public function fakeMaintainer($maintainerFields = [])
    {
        return new Maintainer($this->fakeMaintainerData($maintainerFields));
    }

    /**
     * Get fake data of Maintainer
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMaintainerData($maintainerFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'telefono' => $fake->word
        ], $maintainerFields);
    }
}
