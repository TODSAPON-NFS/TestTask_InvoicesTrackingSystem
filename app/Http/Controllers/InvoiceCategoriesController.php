<?php

namespace App\Http\Controllers;

use App\Models\InvoiceCategory;

class InvoiceCategoriesController extends Controller
{
    public function list()
    {
        $categories = InvoiceCategory::all();
        return response()->json($categories);
    }
}
