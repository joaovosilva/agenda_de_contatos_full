<?php

namespace App\Services\Contracts;

interface UsersInterface
{
    public function find($id);
    public function getAll();
    public function storeOrUpdate($request);
    public function searchByEmail($email);
}
