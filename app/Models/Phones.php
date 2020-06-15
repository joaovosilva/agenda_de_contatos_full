<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phones extends Model
{
    protected $table = "tb_phones";
    protected $primaryKey = "phone_id";

    protected $fillable = [
        "phone",
        "type",
        "contact_fk"
    ];

    public function contato()
    {
        return $this->belongsTo(Contacts::class, 'contact_fk', 'contact_id');
    }
}
