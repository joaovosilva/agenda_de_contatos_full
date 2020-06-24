<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'tb_addresses';
    protected $primaryKey = 'address_id';

    protected $fillable = [
        'zip_code',
        'street',
        'number',
        'neighborhood',
        'complement',
        'city',
        'state',
        'contact_fk',
    ];

    public function contato()
    {
        return $this->belongsTo(Contacts::class, 'contact_fk', 'contact_id');
    }
}
