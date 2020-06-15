<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table = "tb_contacts";
    protected $primaryKey = "contact_id";

    protected $fillable = [
        "name",
        "company",
        "role"
    ];
}
