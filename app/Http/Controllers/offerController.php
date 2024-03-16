<?php

namespace App\Http\Controllers;

use App\Models\agents;
use App\Models\offers;
use App\Models\requests;
use Illuminate\Http\Request;

class offerController extends Controller
{

    public function index()
    {
        return offers::orderBy('Price', 'asc')->get();
    }

    public function offerForSpecificAgent($agentId)
    {
        $agent = agents::find($agentId);
        $offers = $agent->offers;
        return $offers;
    }

    public function offersForSpecificRequest($id)
    {
        return offers::all()->where('request_id', $id);
    }

    public function request()
    {
        return $this->belongsTo(requests::class);
    }

    public function show($id)
    {
        $offers = offers::all()->where('id', $id)->first();
        return $offers == null ? "Not Found" : $offers;
    }

    public function store(Request $req)
    {
        $req->validate([
            "Price" => "required",
            "PL" => "required",
            "TT" => "required",
            "FT" => "required",
            "OF" => "required",
            "THC" => "required",
            "ExtraFees" => "required",
            "PowerPerDay" => "required",
            "agents_id" => "required",
            "request_id" => "required",
            "From" => "required",
            "To" => "required",
        ]);
        offers::create([
            "Price" => $req->Price,
            "PL" => $req->PL,
            "TT" => $req->TT,
            "FT" => $req->FT,
            "OF" => $req->OF,
            "From" => $req->From,
            "To" => $req->To,
            "THC" => $req->To,
            "ExtraFees" => $req->ExtraFees,
            "PowerPerDay" => $req->PowerPerDay,
            "agents_id" => $req->agents_id,
            "request_id" => $req->request_id,
        ]);
        return response()->json([
            "status" => true,
            "message" => "Offer Sent Successfully",
        ]);
    }
}
