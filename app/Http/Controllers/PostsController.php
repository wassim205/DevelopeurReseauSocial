<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with(['comments' => function ($query) {
            $query->latest();
        }])->latest()->get();
        
            $trendingTags = Hashtag::withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(5)
                ->get();
        return view('dashboard', compact('posts', 'trendingTags'));
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
            'hashtags' => 'nullable|string|max:255',

        ]);

        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content_type' => $request->content_type,
            'description' => $request->description,
            'project_link' => $request->project_link,
            'languages_used' => json_encode($request->languages_used),
        ];
        // dd($data);
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
            $post = Post::create($data);
            if ($request->filled('hashtags')) {
                $hashtags = explode(' ', $request->hashtags);
                foreach ($hashtags as $tag) {
                    $tag = trim(strtolower($tag));
                    if (!empty($tag)) {
                        if (!str_starts_with($tag, '#')) {
                            $tag = '#' . $tag;
                        }
                        $hashtag = Hashtag::firstOrCreate(['name' => $tag]);
                        // dd($hashtag);
                        $post->hashtags()->attach($hashtag->id);
                    }
                }
            }


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


    public function toggleLike(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create([
                'user_id' => Auth::id(),
            ]);
            $liked = true;
        }

        $count = $post->likes()->count();
        return response()->json(['liked' => $liked, 'count' => $count]);
    }

    public function storeComment(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->content = $validatedData['content'];
        $comment->save();

        // Return a structured JSON with user info
        return response()->json([
            'user' => [
                'username' => $comment->user->username,
                'githubProfile' => $comment->user->githubProfile,
            ],
            'content' => $comment->content,
        ]);
    }


    private function parseAndAttachHashtags(Post $post, string $content)
    {
        preg_match_all('/#([a-zA-Z0-9]+)/', $content, $matches);
        foreach ($matches[1] as $tag) {
            $hashtag = Hashtag::firstOrCreate(['name' => strtolower($tag)]);
            $post->hashtags()->attach($hashtag->id);
        }
    }
}
