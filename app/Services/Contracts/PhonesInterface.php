<?php

namespace App\Services\Contracts;

interface PhonesInterface
{
    public function find($id);
    public function getAll();
    public function store($request, $id);
    public function searchPhones($contactFk);
    public function deleteContactPhones($id);
}
