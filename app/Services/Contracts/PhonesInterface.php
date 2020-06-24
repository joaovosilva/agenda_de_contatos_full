<?php

namespace App\Services\Contracts;

use App\Services\Params\CreatePhoneServiceParams;

interface PhonesInterface
{
    public function find($id);
    public function getAll();
    public function createPhone(CreatePhoneServiceParams $params);
    public function searchPhones($contactFk);
    public function deleteContactPhones($id);
}
