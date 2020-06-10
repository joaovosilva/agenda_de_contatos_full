<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddressesRepository;
use App\Entities\Addresses;
use App\Validators\AddressesValidator;

/**
 * Class AddressesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AddressesRepositoryEloquent extends BaseRepository implements AddressesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Addresses::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
