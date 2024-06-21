<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use App\Models\shipping_companies;
use Illuminate\Http\Request;

class shipping_companyController extends Controller
{
    public function index()
    {
        return shipping_companies::all();
    }

    public function search(Request $request)
    {
        $searchTerm = $request->name;
        if (empty($searchTerm)) {
            return response()->json(['error' => 'Please provide a search term.'], 400);
        }
        $companies = shipping_companies::where('name', 'like', "%{$searchTerm}%")
            ->get()
            ->toArray();
        return response()->json($companies, 200);
    }

    public function shippingForSpecificAgent($shipping_id)
    {
        return shipping_companies::all()->where('id', $shipping_id);
    }
    public function feedback()
    {
        return $this->hasMany(feedback::class);
    }
}
