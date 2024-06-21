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
        $shippingCompanies = shipping_companies::with('agents.offers', 'feedback', 'posts')->get();

        $result = $shippingCompanies->map(function ($company) {
            $numberOfAgents = $company->agents->count();
            $numberOfOffers = $company->agents->sum(function ($agent) {
                return $agent->offers->count();
            });
            $totalPrices = $company->agents->sum(function ($agent) {
                return $agent->offers->sum(function ($offer) {
                    return $offer->Price + $offer->PL + $offer->TT + $offer->FT + $offer->OF + $offer->THC + $offer->ExtraFees;
                });
            });
            $numberOfFeedbacks = $company->feedback->count();
            $numberOfPosts = $company->posts->count();
            $totalRate = $company->feedback->avg('rate');

            return [
                'Name' => $company->Name,
                'Email' => $company->Email,
                'Website' => $company->Website,
                'NumberOfAgents' => $numberOfAgents,
                'NumberOfOffers' => $numberOfOffers,
                'TotalPrices' => $totalPrices,
                'Address' => $company->Address,
                'PhoneNumber' => $company->PhoneNumber,
                'NumberOfFeedbacks' => $numberOfFeedbacks,
                'NumberOfPosts' => $numberOfPosts,
                'TotalRate' => $totalRate,
            ];
        });

        return response()->json($result);
    }

    public function getClientDetails($id)
    {
        $client = clients::with(['requests', 'feedback'])->find($id);

        if (!$client) {
            return response()->json(['error' => 'Clients not found'], 404);
        }

        $numberOfRequests = $clients->requests->count();
        $feedbackRate = $clients->feedback->avg('rate');
        $acceptedRequestsCount = $clients->requests->whereNotNull('ACCEPT')->count();

        $result = [
            'Name' => $clients->Name,
            'Email' => $clients->Email,
            'SSN' => $clients->SSN,
            'PhoneNumber' => $clients->PhoneNumber,
            'Nationality' => $clients->Nationality,
            'Address' => $clients->Address,
            'NumberOfRequests' => $numberOfRequests,
            'FeedbackRate' => $feedbackRate,
            'AcceptedRequestsCount' => $acceptedRequestsCount,
        ];

        return response()->json($result);
    }
}
