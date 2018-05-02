<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'name'
    ];

    public function invoices()
    {
        return $this->hasMany('\App\Models\Invoice');
    }
}
