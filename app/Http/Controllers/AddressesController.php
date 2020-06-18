<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\UsersService;

class AddressesController extends Controller
{
    // required fields
    protected $validation = [
        "zip_code" => "required",
        "street" => "required",
        "number" => "required",
        "neighborhood" => "required",
        "state" => "required",
        "contact_fk" => "required",
    ];

    public function getContactAddresses(int $contactId)
    {
        $addresses = Addresses::where('contact_fk', '=', $contactId)->get();

        return $addresses;
    }

    // register an address
    public function registerAddress(array $request)
    {
        $validation = Validator::make($request, $this->validation);

        if ($validation->fails()) {
            return ResponseService::returnApi(false, null, null, $validation->errors());
        }

        if (isset($request->address_id)) {
            $validatePhone = Addresses::find($request->address_id);
        }

        if (isset($validatePhone)) {
            $request->address_id = $validatePhone->address_id;
        }

        $address = $this->save($request);

        return $address;
    }

    /**
     * Delete phone
     *
     * @param $id
     * @return array
     */
    public function deleteAddresses($id)
    {
        $addresses = Addresses::where([
            ["contact_fk", "=", $id]
        ])->delete();

        if ($addresses) {
            return $addresses;
        } else {
            return ResponseService::returnApi(true, null, "Endereços não encontrado");
        }
    }
}
