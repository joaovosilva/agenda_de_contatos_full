<?php

namespace App\Services\Contracts;

interface AddressesInterface
{
    public function find($id);
    public function getAll();
    public function storeOrUpdate($request);
    public function searchAddresses($contactFk);
    public function deleteContactAddresses($id);
}
