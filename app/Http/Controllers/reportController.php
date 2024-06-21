<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportController extends Controller
{
    public function getShippingCompanyDetails($id)
    {
        $shippingCompany = DB::table('shipping_companies')
            ->select('shipping_companies.id', 'shipping_companies.Name', 'shipping_companies.Email', 'shipping_companies.Website', 'shipping_companies.Address', 'shipping_companies.PhoneNumber')
            ->selectRaw('(SELECT COUNT(*) FROM agents WHERE agents.shipping_id = shipping_companies.id) AS number_of_agents')
            ->selectRaw('(SELECT COUNT(*) FROM offers o WHERE o.agents_id IN (SELECT id FROM agents WHERE agents.shipping_id = shipping_companies.id)) AS number_of_offers')
            ->selectRaw('(SELECT COUNT(*) FROM feedback WHERE feedback.shipping_company_id = shipping_companies.id) AS number_of_feedback')
            ->where('shipping_companies.id', $id)
            ->first();

        if (!$shippingCompany) {
            return response()->json(['message' => 'Shipping company not found'], 404);
        }

        return response()->json($shippingCompany);
    }
}
