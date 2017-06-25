<?php

use Faker\Factory as Faker;
use App\Models\SpaceType;
use App\Repositories\SpaceTypeRepository;

trait MakeSpaceTypeTrait
{
    /**
     * Create fake instance of SpaceType and save it in database
     *
     * @param array $spaceTypeFields
     * @return SpaceType
     */
    public function makeSpaceType($spaceTypeFields = [])
    {
        /** @var SpaceTypeRepository $spaceTypeRepo */
        $spaceTypeRepo = App::make(SpaceTypeRepository::class);
        $theme = $this->fakeSpaceTypeData($spaceTypeFields);
        return $spaceTypeRepo->create($theme);
    }

    /**
     * Get fake instance of SpaceType
     *
     * @param array $spaceTypeFields
     * @return SpaceType
     */
    public function fakeSpaceType($spaceTypeFields = [])
    {
        return new SpaceType($this->fakeSpaceTypeData($spaceTypeFields));
    }

    /**
     * Get fake data of SpaceType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSpaceTypeData($spaceTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'space_id' => $fake->randomDigitNotNull,
            'precio' => $fake->randomDigitNotNull,
            'capacidad' => $fake->randomDigitNotNull
        ], $spaceTypeFields);
    }
}
