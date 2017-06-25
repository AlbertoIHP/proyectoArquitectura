<?php

use Faker\Factory as Faker;
use App\Models\Space;
use App\Repositories\SpaceRepository;

trait MakeSpaceTrait
{
    /**
     * Create fake instance of Space and save it in database
     *
     * @param array $spaceFields
     * @return Space
     */
    public function makeSpace($spaceFields = [])
    {
        /** @var SpaceRepository $spaceRepo */
        $spaceRepo = App::make(SpaceRepository::class);
        $theme = $this->fakeSpaceData($spaceFields);
        return $spaceRepo->create($theme);
    }

    /**
     * Get fake instance of Space
     *
     * @param array $spaceFields
     * @return Space
     */
    public function fakeSpace($spaceFields = [])
    {
        return new Space($this->fakeSpaceData($spaceFields));
    }

    /**
     * Get fake data of Space
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSpaceData($spaceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'building_id' => $fake->randomDigitNotNull
        ], $spaceFields);
    }
}
