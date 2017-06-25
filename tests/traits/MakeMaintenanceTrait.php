<?php

use Faker\Factory as Faker;
use App\Models\Maintenance;
use App\Repositories\MaintenanceRepository;

trait MakeMaintenanceTrait
{
    /**
     * Create fake instance of Maintenance and save it in database
     *
     * @param array $maintenanceFields
     * @return Maintenance
     */
    public function makeMaintenance($maintenanceFields = [])
    {
        /** @var MaintenanceRepository $maintenanceRepo */
        $maintenanceRepo = App::make(MaintenanceRepository::class);
        $theme = $this->fakeMaintenanceData($maintenanceFields);
        return $maintenanceRepo->create($theme);
    }

    /**
     * Get fake instance of Maintenance
     *
     * @param array $maintenanceFields
     * @return Maintenance
     */
    public function fakeMaintenance($maintenanceFields = [])
    {
        return new Maintenance($this->fakeMaintenanceData($maintenanceFields));
    }

    /**
     * Get fake data of Maintenance
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMaintenanceData($maintenanceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'articulo' => $fake->word,
            'calendar_id' => $fake->randomDigitNotNull,
            'maintainer_id' => $fake->randomDigitNotNull,
            'fecha' => $fake->word
        ], $maintenanceFields);
    }
}
