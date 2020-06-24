<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AddressesRepository;
use App\Models\Addresses;
use App\Validators\AddressesValidator;

/**
 * Class AddressesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AddressesRepositoryEloquent extends BaseRepositoryEloquent implements AddressesRepository
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

    public function getContactAddresses($contactId)
    {
        return $this->model
            ->where('contact_fk', $contactId)
            ->get();
    }

    public function deleteContactAddresses($contactId)
    {
        return $this->model
            ->where('contact_fk', $contactId)
            ->delete();
    }
}
