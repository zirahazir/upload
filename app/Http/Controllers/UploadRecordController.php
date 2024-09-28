<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UploadImport;
use Maatwebsite\Excel\Facades\Excel;

class UploadRecordController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::queueImport(new UploadImport(), $request->file('file'));

        return response()->json(['message' => 'Upload in progress..']);
    }
}
