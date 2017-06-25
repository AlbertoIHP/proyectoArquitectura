<?php

use Faker\Factory as Faker;
use App\Models\Building;
use App\Repositories\BuildingRepository;

trait MakeBuildingTrait
{
    /**
     * Create fake instance of Building and save it in database
     *
     * @param array $buildingFields
     * @return Building
     */
    public function makeBuilding($buildingFields = [])
    {
        /** @var BuildingRepository $buildingRepo */
        $buildingRepo = App::make(BuildingRepository::class);
        $theme = $this->fakeBuildingData($buildingFields);
        return $buildingRepo->create($theme);
    }

    /**
     * Get fake instance of Building
     *
     * @param array $buildingFields
     * @return Building
     */
    public function fakeBuilding($buildingFields = [])
    {
        return new Building($this->fakeBuildingData($buildingFields));
    }

    /**
     * Get fake data of Building
     *
     * @param array $postFields
     * @return array
     */
    public function fakeBuildingData($buildingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'direccion' => $fake->word
        ], $buildingFields);
    }
}
