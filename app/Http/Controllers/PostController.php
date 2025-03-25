<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $data['rows'] = Posts::with(['creator', 'category'])
            ->where('created_by', Auth::id())
            ->get();

        return view('posts.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:1,0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store in public directory with public path
            $imagePath = $request->file('image')->store('public/posts');
            // Convert to public accessible path
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }

        Posts::create([
            'title' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $post = Posts::with(['creator', 'category'])
            ->where('id', $id)
            ->where('created_by', Auth::id()) // Fixed: check created_by instead of id
            ->first();

        if (!$post) {
            return redirect()->route('posts.index')
                ->with('error', 'Post not found or unauthorized.');
        }

        return view('posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }

        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Posts::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
        ]);

        // Update the post
        $post->update([
            'title' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {$post = Posts::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found.');
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
