<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return posts::with('shipping_company')->whereHas('shipping_company')->orderBy('created_at', 'desc')
            ->get();
    }

    public function posts_Shipping($id)
    {
        $posts = posts::all()->where('shipping_companies_id', $id)->values()->toArray();
        if ($posts == []) {
            return response()->json([
                'status' => "404",
                'message' => 'No Posts found for this shipping company.',
            ]);
        }
        return $posts;
    }

    public function show($id)
    {
        $post = posts::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }
        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = posts::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }

        $validatedData = $request->validate([
            'data' => 'required|string',
            'shipping_companies_id' => 'required|integer|exists:shipping_companies,id',
        ]);

        $post->update($validatedData);

        return response()->json(
            [
                'message' => 'This posts Has Been Updated',
                "status" => true,
            ]
        );
    }

    public function destroy($id)
    {
        $post = posts::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }

        $post->delete();

        return response()->json(
            [
                'message' => 'This posts Has Been Deleted',
                "status" => true,
            ]
        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required|string',
            'shipping_companies_id' => 'required|integer|exists:shipping_companies,id',
        ]);

        $post = posts::create($validatedData);

        return response()->json(
            [
                'message' => 'This New posts Has Been Saved',
                "status" => true,
                "posts" => $post
            ]
        );
    }
}
