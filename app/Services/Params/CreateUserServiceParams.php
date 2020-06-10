<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class CreateEmpresasPlanoServiceParams extends BaseServiceParams
{
    public $email;
    public $name;
    public $password;

    public function __construct(
        string $email = null,
        string $name = null,
        string $password = null
    ) {
        parent::__construct();
    }
}
