<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class UpdatePhoneServiceParams extends BaseServiceParams
{
    public $type;
    public $phone;

    public function __construct(
        string $type = null,
        string $phone = null
    ) {
        parent::__construct();
    }
}
