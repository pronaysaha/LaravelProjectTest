<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Store the post in the database
        $post = new Post([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/posts', 'public');
            $post->image = $imagePath;
        }

        auth()->user()->posts()->save($post);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully.');
    }
}
