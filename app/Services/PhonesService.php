<?php

namespace App\Services;

use App\Repositories\Contracts\PhonesRepository;
use App\Services\Contracts\PhonesInterface;
use App\Models\Phones;
use App\Services\Params\CreatePhoneServiceParams;
use App\Services\Responses\ServiceResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            return new ServiceResponse(false, 'Telefone não encontrado');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Telefone encontrados', $phone);
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
            return new ServiceResponse(false, 'Telefones não encontrado');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Telefones encontrados', $phones);
    }

    public function createPhone(CreatePhoneServiceParams $params)
    {
        DB::beginTransaction();
        try {
            $phone = $this->phonesRepository->create($params->toArray());
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Telefone criado com sucesso', $phone);
    }

    public function searchPhones($contactFk)
    {
        try {
            $phones = $this->phonesRepository->getContactPhones($contactFk);
        } catch (ModelNotFoundException $e) {
            return new ServiceResponse(false, 'Telefones não encontrados');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Telefones encontrados', $phones);
    }

    public function deleteContactPhones($contactFk)
    {
        DB::beginTransaction();
        try {
            $phone = $this->phonesRepository->deleteContactPhones($contactFk);
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Telefones encontrados', $phone);
    }
}
