<?php

namespace App\Services;

use App\Repositories\ContactsRepository;
use App\Services\Contracts\ContactsInterface;
use App\Models\Contacts;
use Illuminate\Support\Facades\Auth;

class ContactsService implements ContactsInterface
{
    public $contactsRepository;

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
            return 'Usuário não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $contact;
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
            return 'Usuários não encontrado';
        } catch (Throwable $e) {
            return $e;
        }

        return $contacts;
    }

    public function store($request)
    {

        try {
            $id = Auth::id();

            $contact = $this->contactsRepository->store($request, $id);
        } catch (Throwable $e) {
            return $e;
        }

        return $contact;
    }

    public function update($request, $contactId)
    {
        try {
            $id = Auth::id();
            
            $contact = $this->contactsRepository->update($request, $contactId, $id);
        } catch (Throwable $e) {
            return $e;
        }

        return $contact;
    }

    public function searchContacts($userId)
    {
        try {
            $contacts = $this->contactsRepository->getUserContacts($userId);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (Throwable $e) {
            return $e;
        }

        return $contacts;
    }

    public function deleteContact($id)
    {
        try {
            $contact = $this->find($id);
            $contact = $this->contactsRepository->delete($contact);
        } catch (Throwable $e) {
            return $e;
        }

        return $contact;
    }
}
