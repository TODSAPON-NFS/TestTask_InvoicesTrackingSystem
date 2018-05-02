<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

class VendorController extends Controller
{
    public function list()
    {
        $vendors = Vendor::all();
        return response()->json($vendors);
    }
}
