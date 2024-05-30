<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datapembayaran;

class pembayaran extends Controller
{
    public function index()
    {
        $datapembayarans = Datapembayaran::get();
        return view('pembayaran.index', compact('datapembayarans'));
    }
}
