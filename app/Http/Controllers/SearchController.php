<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::with(['user', 'comments', 'likes', 'hashtags'])  // Eager load the user relationship
    ->where('title', 'like', "%{$query}%")
    ->orWhere('content', 'like', "%{$query}%")
    ->get();


        return response()->json(['posts' => $posts]);
    }
}