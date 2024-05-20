<?php

namespace App\Http\Controllers;

use App\Models\agents;
use App\Models\offers;
use App\Models\requests;
use App\Models\shipping_companies;
use Illuminate\Http\Request;

class offerController extends Controller
{

    public function index()
    {
        $offers = offers::orderBy('price', 'desc')->get();
        $offers->load('request');
        $offers->load('agent');
        return $offers;
    }

    public function indexNotAccept()
    {
        return Offers::with('agent.shipping_companies')
            ->whereHas('request', function ($query) {
                $query->where('ACCEPT', null);
            })
            ->whereHas('agent')
            ->orderBy('Price', 'desc')
            ->get();
    }

    public function AcceptOffers($request_id, $offer_id)
    {
        $rqq = requests::all()->where('id', $request_id)->first();
        $rqq->update([
            "ACCEPT" => 1,
            "ACCEPT_ID" => $offer_id,
        ]);
        return response()->json([
            "status" => true,
            "message" => "This Offer Has Been Accepted" . $rqq->ACCEPT_ID
        ]);
    }

    public function WhichOfferAccept($request_id)
    {
        $rqq = requests::all()->where('id', $request_id)->first();
        $offer = Offers::all()->where('id', $rqq->ACCEPT_ID)->first();
        return response()->json([
            "status" => true,
            "message" => $offer
        ]);
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

    public function show($id)
    {
        $offers = offers::all()->where('id', $id)->first();
        return $offers == null ? "Not Found" : $offers;
    }

    public function store(Request $req)
    {
        $req->validate([
            "Price" => "required",
            "agents_id" => "required",
            "request_id" => "required",
            "From" => "required",
            "To" => "required",
        ]);
        $Requestaya = requests::all()->where('id', $req->request_id)->first();
        if ($Requestaya->CustomsClearness == "1" && $Requestaya->Tracking == "1") {
            offers::create([
                "Price" => $req->Price,
                "PL" => $req->PL,
                "TT" => $req->TT,
                "FT" => $req->FT,
                "OF" => $req->OF,
                "From" => $req->From,
                "To" => $req->To,
                "Comment" => $req->Comment,
                "THC" => $req->THC,
                "ExtraFees" => $req->ExtraFees,
                "PowerPerDay" => $req->PowerPerDay,
                "agents_id" => $req->agents_id,
                "request_id" => $req->request_id,
                "CustomsPrice" => $req->CustomsPrice,
                "TruckingPrice" => $req->TruckingPrice,
            ]);
        } else if ($Requestaya->CustomsClearness == "1") {
            offers::create([
                "Price" => $req->Price,
                "PL" => $req->PL,
                "TT" => $req->TT,
                "FT" => $req->FT,
                "OF" => $req->OF,
                "From" => $req->From,
                "To" => $req->To,
                "Comment" => $req->Comment,
                "THC" => $req->THC,
                "ExtraFees" => $req->ExtraFees,
                "PowerPerDay" => $req->PowerPerDay,
                "agents_id" => $req->agents_id,
                "request_id" => $req->request_id,
                "CustomsPrice" => $req->CustomsPrice,
                "TruckingPrice" => 0,
            ]);
        } else if ($Requestaya->Tracking == "1")
            offers::create([
                "Price" => $req->Price,
                "PL" => $req->PL,
                "TT" => $req->TT,
                "FT" => $req->FT,
                "OF" => $req->OF,
                "From" => $req->From,
                "To" => $req->To,
                "THC" => $req->THC,
                "Comment" => $req->Comment,
                "ExtraFees" => $req->ExtraFees,
                "PowerPerDay" => $req->PowerPerDay,
                "agents_id" => $req->agents_id,
                "request_id" => $req->request_id,
                "TruckingPrice" => $req->TruckingPrice,
                "CustomsPrice" => 0,
            ]);
        else
            offers::create([
                "Price" => $req->Price,
                "PL" => $req->PL,
                "TT" => $req->TT,
                "FT" => $req->FT,
                "OF" => $req->OF,
                "From" => $req->From,
                "To" => $req->To,
                "THC" => $req->THC,
                "Comment" => $req->Comment,
                "ExtraFees" => $req->ExtraFees,
                "PowerPerDay" => $req->PowerPerDay,
                "agents_id" => $req->agents_id,
                "request_id" => $req->request_id,
                "CustomsPrice" => 0,
                "TruckingPrice" => 0,
            ]);
        return response()->json([
            "status" => true,
            "message" => "Offer Sent Successfully",
        ]);
    }

    public function getAgentAndShippingData()
    {
        $offers = Offers::with(['agent', 'agent.shippingCompany'])
            ->get();
        foreach ($offers as $offer) {
            $agentName = $offer->agent ? $offer->agent->name : 'N/A';
            return $agentName;
        }
    }
}
