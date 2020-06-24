<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class CreateContactServiceParams extends BaseServiceParams
{
    public $name;
    public $company;
    public $role;
    public $user_fk;

    public function __construct(
        string $name,
        int $user_fk,
        string $company = null,
        string $role = null
    ) {
        parent::__construct();
    }
}
