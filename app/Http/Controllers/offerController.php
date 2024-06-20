<?php

namespace App\Http\Controllers;

use App\Models\agents;
use App\Models\offers;
use App\Models\requests;
use App\Models\shipping_companies;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class offerController extends Controller
{

    public function index()
    {
        $offers = offers::orderBy('price', 'desc')->get();
        $offers->load('request');
        $offers->load('agent');
        $offers->load('agent.shipping_companies');
        $offers->load('request.client');
        return $offers;
    }

    public function indexNotAccept2()
    {
        $requests = requests::whereNull('ACCEPT')->get();
        $offerIds = $requests->pluck('id');
        $offers = offers::whereIn('id', $offerIds)
            ->orderBy('price', 'desc')
            ->with('request', 'agent', 'agent.shipping_companies', 'request.client')
            ->get();

        return $offers;
    }

    public function indexNotAccept()
    {
        $offer = offers::whereHas('request', function ($query) {
            $query->whereNull('ACCEPT');
        })->get();
        $offer->load('request');
        $offer->load('agent');
        $offer->load('agent.shipping_companies');
        $offer->load('request.client');
        return $offer;
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
        $offers = offers::all()->where('request_id', $id);
        $offers->load('request');
        $offers->load('agent');
        $offers->load('agent.shipping_companies');
        return $offers;
    }

    public function show($id)
    {
        $offers = offers::all()->where('id', $id)->first();
        $offers->load('request');
        $offers->load('agent');
        $offers->load('agent.shipping_companies');
        return $offers;
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
                "totalPrice" => (float) ($req->Price ?? 0) + (float) ($req->PL ?? 0) + (float) ($req->TT ?? 0) +
                    (float) ($req->FT ?? 0) + (float) ($req->OF ?? 0) + (float) ($req->THC ?? 0) +
                    (float) ($req->ExtraFees ?? 0) + (float) ($req->CustomsPrice ?? 0) +
                    (float) ($req->TruckingPrice ?? 0),
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
                "totalPrice" => (float) ($req->Price ?? 0) + (float) ($req->PL ?? 0) + (float) ($req->TT ?? 0) +
                    (float) ($req->FT ?? 0) + (float) ($req->OF ?? 0) + (float) ($req->THC ?? 0) +
                    (float) ($req->ExtraFees ?? 0) + (float) ($req->CustomsPrice ?? 0) +
                    (float) ($req->TruckingPrice ?? 0),
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
                "totalPrice" => (float) ($req->Price ?? 0) + (float) ($req->PL ?? 0) + (float) ($req->TT ?? 0) +
                    (float) ($req->FT ?? 0) + (float) ($req->OF ?? 0) + (float) ($req->THC ?? 0) +
                    (float) ($req->ExtraFees ?? 0) + (float) ($req->CustomsPrice ?? 0) +
                    (float) ($req->TruckingPrice ?? 0),
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
                "totalPrice" => ((float) ($req->Price ?? 0)) + ((float) ($req->PL ?? 0)) + ((float) ($req->TT ?? 0)) +
                    ((float) ($req->FT ?? 0)) + ((float) ($req->OF ?? 0)) + ((float) ($req->THC ?? 0)) +
                    (float) ($req->ExtraFees ?? 0) + (float) ($req->CustomsPrice ?? 0) +
                    ((float) ($req->TruckingPrice ?? 0)),
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
    public function NumberOfOffers($id)
    {
        $offersCount = DB::table('offers')
            ->select(DB::raw('agents.shipping_id, count(*) as offer_count'))
            ->join('agents', 'offers.agents_id', '=', 'agents.id')
            ->where('agents.shipping_id', $id)
            ->groupBy('agents.shipping_id')
            ->get();
        return $offersCount;
    }
    public function sumOfferValuesByShippingId($id)
    {
        $offerSums = DB::table('offers')
            ->select('agents.shipping_id', DB::raw('SUM(Price + PL + TT + FT + OF + THC + ExtraFees) as total_sum'))
            ->join('agents', 'offers.agents_id', '=', 'agents.id')
            ->where('agents.shipping_id', $id)
            ->groupBy('agents.shipping_id')
            ->get();
        return $offerSums;
    }
}
