<?php

namespace App\Http\Controllers;

use App\Phones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhonesController extends Controller
{
    // required fields
    protected $validation = [
        "type" => "required",
        "phone" => "required",
        "contact_fk" => "required"
    ];

    public function getContactPhones(int $contactId)
    {
        $phones = Phones::where('contact_fk', '=', $contactId)->get();

        return $phones;
    }

    // register a phone
    public function registerPhone(array $request)
    {
        $validation = Validator::make($request, $this->validation);

        if ($validation->fails()) {
            return ResponseService::returnApi(false, null, null, $validation->errors());
        }

        if (isset($request->phone_id)) {
            $validatePhone = Phones::find($request->phone_id);
        }

        if (isset($validatePhone)) {
            $request->phone_id = $validatePhone->phone_id;
        }

        $phone = $this->save($request);

        return $phone;
    }

    /**
     * Delete phone
     *
     * @param $id
     * @return array
     */
    public function deletePhones($id)
    {
        $phones = Phones::where([
            ["contact_fk", "=", $id]
        ])->delete();

        if (!$phones) {
            return ResponseService::returnApi(true, null, "Telefones não encontrado");
        }
        
        return $phones;
    }
}
