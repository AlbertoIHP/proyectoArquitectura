<?php

namespace App\Repositories;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'apartment_id',
        'role_id',
        'username',
        'password',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
