<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PhonesRepository;
use App\Models\Phones;
use App\Validators\PhonesValidator;

/**
 * Class PhonesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PhonesRepositoryEloquent extends BaseRepositoryEloquent implements PhonesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Phones::class;
    }

    public function getContactPhones($contactId)
    {
        return $this->model
        ->where('contact_fk', $contactId)
        ->get();
    }

    public function deleteContactPhones($contactId)
    {
        return $this->model
        ->where('contact_fk', $contactId)
        ->delete();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
