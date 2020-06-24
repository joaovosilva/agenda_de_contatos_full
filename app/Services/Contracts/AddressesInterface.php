<?php

namespace App\Services\Contracts;

use App\Services\Params\CreateAddressServiceParams;

interface AddressesInterface
{
    public function find($id);
    public function getAll();
    public function createAddress(CreateAddressServiceParams $params);
    public function searchAddresses($contactFk);
    public function deleteContactAddresses($id);
}
