<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data['rows'] = Category::with('creator')
            ->where('id', Auth::id()) // Show only posts created by the logged-in user
            ->get();

        return view('category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('category.create');
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
            'status' => 'required|in:1,0',
        ]);
        Category::create([
            'title' => $request->name,
            'status' => $request->status,
            'created_by' => Auth::id(), // Add the authenticated user's ID
        ]);

        return redirect()->route('category.index')->with('success', 'category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find the post by ID, but only if it belongs to the logged-in user
        $category = Category::where('id', $id)->
        with('creator')
            ->where('id', Auth::id()) // Ensures the post belongs to the logged-in user
            ->first();

        // If the category is not found, redirect with an error message
        if (!$category) {
            return redirect()->route('category.index')->with('error', 'category not found or unauthorized.');
        }

        // Return the view for showing the post details
        return view('category.show', compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('category.index')->with('error', 'category not found.');
        }

        return view('category.edit', compact('category'));
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
        $post = Category::find($id);

        if (!$post) {
            return redirect()->route('category.index')->with('error', 'category not found.');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        // Update the post
        $post->update([
            'title' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('category.index')->with('success', 'category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {$post = Category::find($id);

        if (!$post) {
            return redirect()->route('category.index')->with('error', 'category not found.');
        }
        $post->delete();
        return redirect()->route('category.index')->with('success', 'category deleted successfully.');
    }


}
