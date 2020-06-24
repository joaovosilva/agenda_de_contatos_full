<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ContactsRepository;
use App\Models\Contacts;
use App\Validators\ContactsValidator;

/**
 * Class ContactsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactsRepositoryEloquent extends BaseRepositoryEloquent implements ContactsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contacts::class;
    }

    public function getUserContacts($userId)
    {
        return $this->model
        ->where('user_fk', $userId)
        ->get();
    }
}
