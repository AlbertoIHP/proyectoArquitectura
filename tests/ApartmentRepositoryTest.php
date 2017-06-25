<?php

use App\Models\Apartment;
use App\Repositories\ApartmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApartmentRepositoryTest extends TestCase
{
    use MakeApartmentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApartmentRepository
     */
    protected $apartmentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->apartmentRepo = App::make(ApartmentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateApartment()
    {
        $apartment = $this->fakeApartmentData();
        $createdApartment = $this->apartmentRepo->create($apartment);
        $createdApartment = $createdApartment->toArray();
        $this->assertArrayHasKey('id', $createdApartment);
        $this->assertNotNull($createdApartment['id'], 'Created Apartment must have id specified');
        $this->assertNotNull(Apartment::find($createdApartment['id']), 'Apartment with given id must be in DB');
        $this->assertModelData($apartment, $createdApartment);
    }

    /**
     * @test read
     */
    public function testReadApartment()
    {
        $apartment = $this->makeApartment();
        $dbApartment = $this->apartmentRepo->find($apartment->id);
        $dbApartment = $dbApartment->toArray();
        $this->assertModelData($apartment->toArray(), $dbApartment);
    }

    /**
     * @test update
     */
    public function testUpdateApartment()
    {
        $apartment = $this->makeApartment();
        $fakeApartment = $this->fakeApartmentData();
        $updatedApartment = $this->apartmentRepo->update($fakeApartment, $apartment->id);
        $this->assertModelData($fakeApartment, $updatedApartment->toArray());
        $dbApartment = $this->apartmentRepo->find($apartment->id);
        $this->assertModelData($fakeApartment, $dbApartment->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteApartment()
    {
        $apartment = $this->makeApartment();
        $resp = $this->apartmentRepo->delete($apartment->id);
        $this->assertTrue($resp);
        $this->assertNull(Apartment::find($apartment->id), 'Apartment should not exist in DB');
    }
}
