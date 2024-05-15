<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class feedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::all();
        return response()->json($feedback);
    }

    public function show(Feedback $feedback)
    {
        return response()->json($feedback);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required|string',
            'rate' => 'required|numeric|between:0,5',
            'shipping_company_id' => 'required|exists:shipping_companies,id',
            'client_id' => 'required|exists:clients,id',
        ]);

        $feedback = Feedback::create($validatedData);

        return response()->json($feedback, 201); // Created status code
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validatedData = $request->validate([
            'message' => 'string|nullable',
            'rate' => 'numeric|between:0,5',
        ]);

        $feedback->update($validatedData);

        return response()->json($feedback);
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return response()->json(null, 204); // No Content status code
    }

    public function getAverageRatingById($id)
    {
        $averageRatings = Feedback::select('shipping_company_id', DB::raw('AVG(rate) as average_rate'))
            ->groupBy('shipping_company_id')
            ->where('shipping_company_id', $id)
            ->get();

        return response()->json($averageRatings);
    }
}
