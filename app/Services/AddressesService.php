<?php

namespace App\Services;

use App\Repositories\Contracts\AddressesRepository;
use App\Services\Contracts\AddressesInterface;
use App\Models\Addresses;
use App\Services\Params\CreateAddressServiceParams;
use App\Services\Responses\ServiceResponse;
use Illuminate\Support\Facades\DB;

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
            return new ServiceResponse(false, 'Endereço não encontrado');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Endereço encontrado', $address);
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
            return new ServiceResponse(false, 'Endereços não encontrado');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Endereços encontrados', $addresses);
    }

    public function createAddress(CreateAddressServiceParams $params)
    {
        DB::beginTransaction();
        try {
            $address = $this->addressesRepository->create($params->toArray());
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Endereço criado com sucesso', $address);
    }

    public function searchAddresses($contactFk)
    {
        try {
            $addresses = $this->addressesRepository->getContactAddresses($contactFk);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Endereços encontrados', $addresses);
    }

    public function deleteContactAddresses($contactFk)
    {
        DB::beginTransaction();
        try {
            $address = $this->addressesRepository->deleteContactAddresses($contactFk);
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Endereço deletado com sucesso', $address);
    }
}
