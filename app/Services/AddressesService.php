<?php

namespace App\Services;

use App\Repositories\AddressesRepository;
use App\Services\Contracts\AddressesInterface;
use App\Addresses;

class AddressesService implements AddressesInterface
{
    public $addressesRepository;

    public function __construct(AddressesRepository $addressesRepository)
    {
        $this->addressesRepository = $addressesRepository;
    }

    /**
     * Traz um contato pelo id
     *
     * @param  int|string $id
     *
     * @return address
     */
    public function find($id)
    {
        try {
            $address = $this->addressesRepository->find($id);
        } catch (ModelNotFoundException $e) {
            return 'Endereço não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $address;
    }
    /**
     * Traz todos contatos
     *
     * @return addresses
     */
    public function getAll()
    {
        try {
            $addresses = $this->addressesRepository->getAll();
        } catch (ModelNotFoundException $e) {
            return 'Endereços não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $addresses;
    }

    public function storeOrUpdate($request)
    {
        try {
            $address = $this->addressesRepository->save($request);
        } catch (Throwable $e) {
            return $e;
        }

        return $address;
    }

    public function searchAddresses($contactFk)
    {
        try {
            $phones = $this->addressesRepository->getContactAddresses($contactFk);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (Throwable $e) {
            return $e;
        }

        return $phones;
    }

    public function deleteContactAddresses($contactFk)
    {
        try {
            $address = $this->addressesRepository->delete($contactFk);
        } catch (Throwable $e) {
            return $e;
        }

        return $address;
    }
}
