<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function showCreatePostPage()
    {
        return view("posts.create");
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'imagePost' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',

            // Validasi Array Instruksi
            'instructions' => 'array',          // Memastikan ada array instruksi
            'instructions.*' => 'nullable|string|max:500', // Validasi setiap item dalam array
        ]);

        $cleanedInstructions = array_filter($request->input('instructions'));

        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => json_encode($cleanedInstructions),
        ];

        if ($request->hasFile('imagePost')) {
            $path = $request->file('imagePost')->store('posts/covers', 'public');
            $data['image_url'] = $path;
        }

        Post::create($data);
        return redirect()->route('blogs');
    }

    public function showPostPage()
    {
        return view("posts.app");
    }
}
