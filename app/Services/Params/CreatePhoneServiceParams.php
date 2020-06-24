<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class CreatePhoneServiceParams extends BaseServiceParams
{
    public $type;
    public $phone;
    public $contact_fk;

    public function __construct(
        string $type = null,
        string $phone = null,
        int $contact_fk = null
    ) {
        parent::__construct();
    }
}
