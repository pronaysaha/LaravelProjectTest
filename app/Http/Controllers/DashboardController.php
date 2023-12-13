<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the authenticated user's posts
        $posts = auth()->user()->posts;

        return view('dashboard.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

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

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        // Ensure the user owns the post
        $this->authorize('update', $post);

        return view('dashboard.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Ensure the user owns the post
        $this->authorize('update', $post);

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the post in the database
        $post->title = $request->input('title');
        $post->text = $request->input('text');

        // Handle image update if provided
        if ($request->hasFile('image')) {
            // Delete the previous image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('images/posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // Ensure the user owns the post
        $this->authorize('delete', $post);

        // Delete the post from the database
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }
}
