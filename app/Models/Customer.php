<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    public $timestamps = true;

    protected $fillable = [
        'email', 'first_name', 'last_name'
    ];

    protected $appends = ['name'];

    public function invoices()
    {
        return $this->hasMany('\App\Models\Invoice');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
