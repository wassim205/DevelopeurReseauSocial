<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Log::info('Index method reached');

        $posts = Post::latest()->get(); // Add parentheses after get
        // dd($posts);
        return view('dashboard', compact('posts'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); 
        $request->validate([
            'title' => 'required|string|max:255',
            'content_type' => 'required|in:text,code,image,link',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'description' => 'nullable|string',
            'project_link' => 'nullable|url',
            'languages_used' => 'nullable|string',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content_type' => $request->content_type,
            'description' => $request->description,
            'project_link' => $request->project_link,
            'languages_used' => json_encode($request->languages_used),
        ];
        switch ($request->content_type) {
            case 'text':
            case 'code':
            case 'link':
                $data['content'] = $request->content;
                break;
            case 'image':
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('images', 'public');
                    $data['content'] = $imagePath;
                }
                break;
        }

        try {
            // dd($request->content_type);
            // dd($data);
            Post::create($data);
            return redirect()->route('dashboard')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create post: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
