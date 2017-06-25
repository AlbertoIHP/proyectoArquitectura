<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApartmentApiTest extends TestCase
{
    use MakeApartmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateApartment()
    {
        $apartment = $this->fakeApartmentData();
        $this->json('POST', '/api/v1/apartments', $apartment);

        $this->assertApiResponse($apartment);
    }

    /**
     * @test
     */
    public function testReadApartment()
    {
        $apartment = $this->makeApartment();
        $this->json('GET', '/api/v1/apartments/'.$apartment->id);

        $this->assertApiResponse($apartment->toArray());
    }

    /**
     * @test
     */
    public function testUpdateApartment()
    {
        $apartment = $this->makeApartment();
        $editedApartment = $this->fakeApartmentData();

        $this->json('PUT', '/api/v1/apartments/'.$apartment->id, $editedApartment);

        $this->assertApiResponse($editedApartment);
    }

    /**
     * @test
     */
    public function testDeleteApartment()
    {
        $apartment = $this->makeApartment();
        $this->json('DELETE', '/api/v1/apartments/'.$apartment->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/apartments/'.$apartment->id);

        $this->assertResponseStatus(404);
    }
}
