<?php

namespace App\Http\Controllers;

use App\Models\InvoiceStatus;

class InvoiceStatusesController extends Controller
{
    public function list()
    {
        $statuses = InvoiceStatus::all();
        return response()->json($statuses);
    }
}
