<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContactsRepository;
use App\Entities\Contacts;
use App\Validators\ContactsValidator;

/**
 * Class ContactsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactsRepositoryEloquent extends BaseRepository implements ContactsRepository
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

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
