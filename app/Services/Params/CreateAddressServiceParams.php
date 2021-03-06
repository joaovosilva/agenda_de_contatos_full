<?php

namespace App\Services\Params;

use Carbon\Carbon;
use App\Services\Params\BaseServiceParams;

class CreateAddressServiceParams extends BaseServiceParams
{
    public $zip_code;
    public $street;
    public $number;
    public $neighborhood;
    public $complement;
    public $city;
    public $state;
    public $contact_fk;

    public function __construct(
        string $zip_code = null,
        string $street = null,
        string $number = null,
        string $neighborhood = null,
        ?string $complement = null,
        string $city = null,
        string $state = null,
        int $contact_fk = null
    ) {
        parent::__construct();
    }
}
