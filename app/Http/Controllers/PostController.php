<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return redirect()->route('posts');
    }

    public function showPostPage()
    {
        $posts = Post::with('user')->get();
        return view("posts.app", [
            "posts" => $posts
        ]);
    }

    public function showUserLoginPosts()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->with('user')->get();
        return view("posts.app", [
            "posts" => $posts
        ]);
    }

    public function showUpdatePost($slug)
    {
        try {
            // Attempt to find the post by slug
            $post = Post::where('slug', $slug)->firstOrFail();

            // Return the view with the found post
            return view("posts.update", [
                'post' => $post,
            ]);
        } catch (ModelNotFoundException $e) {
            // Handle the case when the post is not found
            return redirect()->route('posts');
        }
    }

    public function updatePost(Request $request, string $slug)
    {
        $validated = $request->validate([
            'imagePost' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title' => 'string|max:255',
            'description' => 'string',
            'ingredients' => 'string',

            // Validasi Array Instruksi
            'instructions' => 'array',          // Memastikan ada array instruksi
            'instructions.*' => 'nullable|string|max:500', // Validasi setiap item dalam array
        ]);

        try {
            $post = Post::where('slug', $slug)->firstOrFail();

            $post->title = $request->title ?: $post->title; // Jika title ada, ganti, jika tidak biarkan yang lama
            $post->description = $request->description ?: $post->description;
            $post->ingredients = $request->ingredients ?: $post->ingredients;

            $cleanedInstructions = array_filter($request->input('instructions'));
            $post->instructions = json_encode($cleanedInstructions);

            if ($request->hasFile('imagePost')) {
                // Hapus gambar lama jika ada
                if ($post->image_url) {
                    Storage::disk('public')->delete($post->image_url);
                }

                // Upload gambar baru
                $path = $request->file('imagePost')->store('posts/covers', 'public');
                $post->image_url = $path;
            }

            $post->save();
            return redirect()->route('posts.update.form', $post->slug);

        } catch(ModelNotFoundException $e) {
            return redirect()->route('posts');
        }
    }

    public function deletePost(string $slug)
    {
        try {
            // Cari post berdasarkan slug
            $post = Post::where('slug', $slug)->firstOrFail();

            // Cek jika post memiliki gambar dan hapus dari storage
            if ($post->image_url) {
                // Menghapus gambar dari storage
                Storage::disk('public')->delete($post->image_url);
            }

            // Hapus post dari database
            $post->delete();

            // Redirect setelah penghapusan
            return redirect()->route('posts');
        } catch (ModelNotFoundException $e) {
            // Jika post tidak ditemukan, redirect ke halaman posts
            return redirect()->route('posts');
        }
    }
}
