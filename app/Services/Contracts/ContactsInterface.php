<?php

namespace App\Services\Contracts;

use App\Services\Params\CreateContactServiceParams;
use App\Services\Params\UpdateContactServiceParams;

interface ContactsInterface
{
    public function find($id);
    public function getAll();
    public function createContact(CreateContactServiceParams $params);
    public function updateContact(UpdateContactServiceParams $params, $id);
    public function searchContacts($contactFk);
    public function deleteContact($id);
}
