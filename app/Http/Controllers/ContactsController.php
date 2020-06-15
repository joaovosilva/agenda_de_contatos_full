<?php

namespace App\Http\Controllers;

use App\Contacts;
use App\Http\Requests\ContactsRequest;
use App\Services\AddressesService;
use App\Services\ContactsService;
use App\Services\PhonesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    protected $contactsService;
    protected $phonesService;
    protected $addressesService;

    public function __construct(
        ContactsService $contactsService,
        PhonesService $phonesService,
        AddressesService $addressesService
    ) {
        $this->contactsService = $contactsService;
        $this->phonesService = $phonesService;
        $this->addressesService = $addressesService;
    }

    public function getContactById($id)
    {

        if (!ResponseService::validationUser()) {
            return ResponseService::returnApi(false, null, "Autenticação Invállida");
        }

        $contact = $this->contactsService->find($id);

        if (!$contact) {
            return ResponseService::returnApi(false, null, "Contato não encontrado");
        }

        $phones = $this->phonesService->searchPhones($contact->contact_id);

        $addresses = $this->addressesService->searchAddresses($contact->contact_id);

        $contact->phones = $phones;
        $contact->addresses = $addresses;

        return ResponseService::returnApi(true, $contact, null);
    }

    public function getUserContacts($id)
    {
        $contacts = $this->contactsService->searchContacts($id);

        if (!$contacts) {
            return ResponseService::returnApi(true, null, "Contato não encontrado");
        }

        foreach ($contacts as $contact) {
            $phones = $this->phonesService->searchPhones($contact->contact_id);

            $addresses = $this->addressesService->searchAddresses($contact->contact_id);

            $contact->phones = $phones;
            $contact->addresses = $addresses;
        }

        return view('contacts', compact('contacts'));
    }

    // register a contact
    public function registerContact(ContactsRequest $request)
    {
        if (isset($request->contact_id)) {
            $contactsExists = $this->contactsService->find($request->contact_id);
            $request->contact_id = $contactsExists->contact_id;
        }

        $contact = $this->contactsService->storeOrUpdate($request);

        $phoneArray = [];
        foreach ($request->phones as $phone) {
            $phone['contact_fk'] = $contact->contact_id;
            $newPhone = $this->phonesService->storeOrUpdate($phone);
            array_push($phoneArray, $newPhone);
        }

        $addressArray = [];
        foreach ($request->addresses as $address) {
            $address['contact_fk'] = $contact->contact_id;
            $newAddress = $this->addressesService->storeOrUpdate($address);
            array_push($addressArray, $newAddress);
        }

        $contact->phones = $phoneArray;
        $contact->addresses = $addressArray;

        return ResponseService::returnApi(true, $contact);
    }

    /**
     * Delete contact
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function deleteContact($id)
    {
        if (!ResponseService::validationUser()) {
            return ResponseService::returnApi(false, null, "Autenticação Invállida");
        }

        $contact = $this->contactsService->find($id);

        if (!$contact) {
            return ResponseService::returnApi(false, null, "Contato não encontrado");
        }

        $this->phonesService->deleteContactPhones($id);

        $this->addressesService->deleteContactAddresses($id);

        $this->contactsService->deleteContact($id);

        return ResponseService::returnApi(true, null, "Contato excluido com sucesso");
    }

    public function contactForm()
    {
        return view('contact-form');
    }
}
