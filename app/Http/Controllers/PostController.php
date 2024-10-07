<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $posts = Post::when($searchTerm, function ($query) use ($searchTerm) {
            $query->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        })->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
{
    return view('posts.create');
}
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('posts') : null;

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->input('title');
        $post->description = $request->input('description');

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id); 
        
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action');
        }
        
        $post->delete(); 
        
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $posts = Post::where('title', 'LIKE', "%{$searchTerm}%")
                     ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                     ->paginate(10);

        return view('posts.index', compact('posts'));
    }
    
}
