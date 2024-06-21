<?php

namespace App\Http\Controllers;

use App\Models\shipping_companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
