<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'price'
    ];

    public function category()
    {
        return $this->belongsTo('\App\Models\InvoiceCategory');
    }

    public function status()
    {
        return $this->belongsTo('\App\Models\InvoiceStatus');
    }

    public function customer()
    {
        return $this->belongsTo('\App\Models\Customer');
    }

    public function vendor()
    {
        return $this->belongsTo('\App\Models\Vendor');
    }

    public function scopeAllData($query)
    {
        return $query->with(['customer', 'category', 'status', 'vendor']);
    }
}
