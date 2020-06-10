<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PhonesRepository;
use App\Entities\Phones;
use App\Validators\PhonesValidator;

/**
 * Class PhonesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PhonesRepositoryEloquent extends BaseRepository implements PhonesRepository
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

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
