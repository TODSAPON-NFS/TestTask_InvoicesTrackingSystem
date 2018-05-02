<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('invoices');
    }

    public function list(Request $request)
    {
        $invoices = Invoice::allData()->orderBy('id', 'desc')->paginate(5);
        return response()->json([
            'invoices' => $invoices
        ]);
    }

    public function store(InvoiceRequest $request)
    {
        if (Invoice::create($request->all())) {
            return response(200);
        } else {
            return response(500);
        }
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
    }
}
