<?php

namespace App\Services;

use App\Repositories\PhonesRepository;
use App\Services\Contracts\PhonesInterface;
use App\Models\Phones;

class PhonesService implements PhonesInterface
{
    public $phonesRepository;

    public function __construct(PhonesRepository $phonesRepository)
    {
        $this->phonesRepository = $phonesRepository;
    }

    /**
     * Traz um contato pelo id
     *
     * @param  int|string $id
     *
     * @return phone
     */
    public function find($id)
    {
        try {
            $phone = $this->phonesRepository->find($id);
        } catch (ModelNotFoundException $e) {
            return 'Telefone não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $phone;
    }
    /**
     * Traz todos contatos
     *
     * @return phones
     */
    public function getAll()
    {
        try {
            $phones = $this->phonesRepository->getAll();
        } catch (ModelNotFoundException $e) {
            return 'Telefones não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $phones;
    }

    public function store($request, $contactFk)
    {
        try {
            $phone = $this->phonesRepository->store($request, $contactFk);
        } catch (Throwable $e) {
            return $e;
        }

        return $phone;
    }

    public function searchPhones($contactFk)
    {
        try {
            $phones = $this->phonesRepository->getContactPhones($contactFk);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (Throwable $e) {
            return $e;
        }

        return $phones;
    }

    public function deleteContactPhones($contactFk)
    {
        try {
            $phone = $this->phonesRepository->delete($contactFk);
        } catch (Throwable $e) {
            return $e;
        }

        return $phone;
    }
}
