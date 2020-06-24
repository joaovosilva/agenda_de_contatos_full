<?php

namespace App\Services;

use App\Repositories\Contracts\ContactsRepository;
use App\Services\Contracts\ContactsInterface;
use App\Models\Contacts;
use App\Services\Params\CreateContactServiceParams;
use App\Services\Params\UpdateContactServiceParams;
use App\Services\Responses\ServiceResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ContactsService implements ContactsInterface
{
    private $contactsRepository;

    public function __construct(ContactsRepository $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    /**
     * Traz um contato pelo id
     *
     * @param  int|string $id
     *
     * @return contact
     */
    public function find($id)
    {
        try {
            $contact = $this->contactsRepository->find($id);
        } catch (ModelNotFoundException $e) {
            return new ServiceResponse(false, 'Model não encontrada');
        } catch (HttpException $e) {
            return new ServiceResponse(false, 'Contato não encontrado');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Contato encontrado', $contact);
    }
    /**
     * Traz todos contatos
     *
     * @return contacts
     */
    public function getAll()
    {
        try {
            $contacts = $this->contactsRepository->getAll();
        } catch (ModelNotFoundException $e) {
            return new ServiceResponse(false, 'Model não encontrada');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Contatos encontrados', $contacts);
    }

    public function createContact(CreateContactServiceParams $params)
    {
        DB::beginTransaction();
        try {
            $contact = $this->contactsRepository->create($params->toArray());
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Contato criado com sucesso', $contact);
    }

    public function updateContact(UpdateContactServiceParams $params, $contactId)
    {
        DB::beginTransaction();
        try {
            $contact = $this->contactsRepository->update($params->toArray(), $contactId);
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Contato atualizado com sucesso', $contact);
    }

    public function searchContacts($userId)
    {
        try {
            $contacts = $this->contactsRepository->getUserContacts($userId);
        } catch (ModelNotFoundException $e) {
            return new ServiceResponse(false, 'Model não encontrada');
        } catch (Throwable $e) {
            return new ServiceResponse(false, $e->getMessage());
        }

        return new ServiceResponse(true, 'Contatos do usuário encontrados', $contacts);
    }

    public function deleteContact($id)
    {
        DB::beginTransaction();
        try {
            $contact = $this->contactsRepository->delete($id);
        } catch (Throwable $e) {
            DB::rollback();
            return new ServiceResponse(false, $e->getMessage());
        }
        DB::commit();

        return new ServiceResponse(true, 'Contato deletado com sucesso', $contact);
    }
}
