<?php

namespace App\Services\Contracts;

interface ContactsInterface
{
    public function find($id);
    public function getAll();
    public function storeOrUpdate($request);
    public function searchContacts($contactFk);
    public function deleteContact($id);
}
