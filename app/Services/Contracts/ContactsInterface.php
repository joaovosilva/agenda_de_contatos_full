<?php

namespace App\Services\Contracts;

use App\Http\Requests\ContactsRequest;

interface ContactsInterface
{
    public function find($id);
    public function getAll();
    public function store(ContactsRequest $request);
    public function update(ContactsRequest $request, $id);
    public function searchContacts($contactFk);
    public function deleteContact($id);
}
