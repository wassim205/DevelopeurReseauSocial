<?php

namespace App\Http\Controllers;

use App\Events\CommentNotificationtion;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Notifications\CommentNotification as notifCommentNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events;
use App\Events\CommentNotification;
use App\Events\LikeNotificationEvent;
use App\Notifications\LikeNotification;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function comment()
    // {
    //     $user = User::find(1);
    //     $user->notify(new CommentNotification());

    //     event(new TestNotification([
    //         'comment' => 'hello',
    //     ]));
    //     dd("notification sent");
    // }
    public function index()
    {

        $posts = Post::with(['comments' => function ($query) {
            $query->latest();
        }])->latest()->get();

        $trendingTags = Hashtag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

            // $unreadNotifications = Auth::user()->unreadNotifications()->count();

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
    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->route('posts.index')->with('error', 'Post not found');
        }

        return view('posts.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'description' => 'nullable|string',
            'project_link' => 'nullable|url',
            'languages_used' => 'nullable|string',
        ]);

        // Find the post by ID and update the data
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->description = $request->input('description');
        $post->project_link = $request->input('project_link');
        $post->languages_used = $request->input('languages_used');

        $post->save();

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }



    public function toggleLike(Post $post)
    {
        // dd('ubzbd');
        $like = $post->likes()->where('user_id', Auth::id())->first();
        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create([
                'user_id' => Auth::id(),
            ]);
            $liked = true;
            // dd('hehe');
            if (Auth::id() !== $post->user_id) {

                $postOwner = User::find($post->user_id);
                if ($postOwner) {
                    $postOwner->notify(new LikeNotification($post));
                }

                event(new LikeNotificationEvent([
                    'liked_user' => [
                        'id' => Auth::id(),
                        'name' => Auth::user()->username
                    ],
                    'message' => 'Liked your post',
                    'post_owner_id' => $post->user_id,
                    'post_title' => $post->title,
                ]));
            }
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

        //     $user = User::find($post->user_id);
        //     if($user !== Auth::id()){
        //     $user->notify(new CommentNotification($post));

        //     event(new CommentNotificationtion([
        //         'comment' => 'hello',
        //         'post_owner_id' => $post->user_id,
        //     ]));
        // }

        if (auth()->id() !== $post->user_id) {
            $postOwner = User::find($post->user_id);
            if ($postOwner) {
                $postOwner->notify(new notifCommentNotification($post, $comment));
            }

            // Broadcast event
            // event(new CommentNotification([
            //     'commented_user' => Auth::user(),
            //     'commented_message' => $comment->content,
            //     'message' => 'commented on your post',
            //     'post_owner_id' => $post->user_id,
            //     'post_title' => $post->title,
            //     // 'commented_at' => $post->comment->created_at
            // ]));

            event(new CommentNotification([
                'commented_user' => [
                    'id' => Auth::id(),
                    'name' => Auth::user()->username
                ],
                'commented_message' => $comment->content,
                'message' => 'commented on your post',
                'post_owner_id' => $post->user_id,
                'post_title' => $post->title,
            ]));
        }

        // Return a structured JSON with user info
        return response()->json([
            'user' => [
                'username' => $comment->user->username,
                'githubProfile' => $comment->user->githubProfile,
            ],
            'content' => $comment->content,
        ]);
    }
}
