<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class UpdateContactServiceParams extends BaseServiceParams
{
    public $name;
    public $company;
    public $role;

    public function __construct(
        string $name = null,
        ?string $company = null,
        ?string $role = null
    ) {
        parent::__construct();
    }
}
