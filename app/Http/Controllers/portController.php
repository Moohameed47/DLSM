<?php

namespace App\Http\Controllers;

use App\Models\ports;
use Illuminate\Http\Request;

class portController extends Controller
{
    //
    public function index()
    {
        return ports::all();
    }

    public function show($id)
    {
        return ports::all()->where('country_id', $id)->values()->toArray();
    }

    public function store(Request $request)
    {
        $request->validate([
            "Name" => "required",
            "country_id" => "required",
        ]);
        ports::create([
            "Name" => $request->Name,
            "country_id" => $request->country_id,
        ]);
        return response()->json([
            "status" => true,
            "message" => "Port Saved Successfully",
        ]);
    }
}
