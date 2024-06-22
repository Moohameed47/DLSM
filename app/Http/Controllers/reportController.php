<?php

namespace App\Http\Controllers;

use App\Models\shipping_companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\agents;
use App\Models\clients;
use App\Models\feedback;
use App\Models\requests;

class reportController extends Controller
{
    public function getShippingCompanyDetails($id)
    {
        $shippingCompany = shipping_companies::with(['agents.offers.request', 'feedback', 'posts'])->find($id);

        if (!$shippingCompany) {
            return response()->json(['error' => 'Shipping company not found'], 404);
        }

        $numberOfAgents = $shippingCompany->agents->count();
        $numberOfOffers = $shippingCompany->agents->sum(function ($agent) {
            return $agent->offers->count();
        });
        $totalPrices = $shippingCompany->agents->sum(function ($agent) {
            return $agent->offers->sum(function ($offer) {
                return $offer->Price + $offer->PL + $offer->TT + $offer->FT + $offer->OF + $offer->THC + $offer->ExtraFees;
            });
        });
        $numberOfFeedbacks = $shippingCompany->feedback->count();
        $numberOfPosts = $shippingCompany->posts->count();
        $totalRate = $shippingCompany->feedback->avg('rate') ?? 0;

        $acceptedOffers = $shippingCompany->offers->filter(function ($offer) {
            return $offer->request->ACCEPT === 1;
        });

        $numberOfAcceptedOffers = $acceptedOffers->count();

        // Create an array of accepted offers details
        $acceptedOffersDetails = $acceptedOffers->map(function ($offer) {
            return [
                'id' => $offer->id,
                'Price' => $offer->Price,
                'PL' => $offer->PL,
                'TT' => $offer->TT,
                'FT' => $offer->FT,
                'OF' => $offer->OF,
                'THC' => $offer->THC,
                'ExtraFees' => $offer->ExtraFees,
                'request_id' => $offer->request_id,
                // Add other offer fields as needed
            ];
        });

        $result = [
            'Name' => $shippingCompany->Name,
            'Email' => $shippingCompany->Email,
            'Website' => $shippingCompany->Website,
            'NumberOfAgents' => $numberOfAgents,
            'NumberOfOffers' => $numberOfOffers,
            'TotalPrices' => $totalPrices,
            'Address' => $shippingCompany->Address,
            'PhoneNumber' => $shippingCompany->PhoneNumber,
            'NumberOfFeedbacks' => $numberOfFeedbacks,
            'NumberOfPosts' => $numberOfPosts,
            'TotalRate' => $totalRate,
            'NumberOfAcceptedOffers' => $numberOfAcceptedOffers,
            'AcceptedOffers' => $acceptedOffersDetails,
        ];

        return response()->json($result);
    }

    public function getClientDetails($id)
    {
        $client = clients::with(['requests', 'feedback'])->find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $numberOfRequests = $client->requests->count();
        $feedbackRate = $client->feedback->avg('rate') ?? 0;
        $acceptedRequestsCount = $client->requests->whereNotNull('ACCEPT')->count();

        $result = [
            'Name' => $client->Name,
            'Email' => $client->Email,
            'SSN' => $client->SSN,
            'PhoneNumber' => $client->PhoneNumber,
            'Nationality' => $client->Nationality,
            'Address' => $client->Address,
            'NumberOfRequests' => $numberOfRequests,
            'FeedbackRate' => $feedbackRate,
            'AcceptedRequestsCount' => $acceptedRequestsCount,
        ];

        return response()->json($result);
    }
}