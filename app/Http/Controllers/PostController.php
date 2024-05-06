<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return $posts;
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }
        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }

        $validatedData = $request->validate([
            'data' => 'required|string',
            'shipping_companies_id' => 'required|integer|exists:shipping_companies,id',
        ]);

        $post->update($validatedData);

        return response()->json(
            ['message' => 'This Post Has Been Updated',
                "status" => true,
            ]
        );
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return abort(404); // Handle post not found
        }

        $post->delete();

        return response()->json(
            ['message' => 'This Post Has Been Deleted',
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

        $post = Post::create($validatedData);

        return response()->json(
            ['message' => 'This New Post Has Been Saved',
                "status" => true,
                "Post" => $post
            ]
        );
    }
}
