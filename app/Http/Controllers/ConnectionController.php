<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{
    public function add($receiverId)
    {
        $authUserId = Auth::id();

        if ($authUserId == $receiverId) {
            return redirect()->back()->with('error', 'You cannot send a connection request to yourself.');
        }

        // Check if a request already exists
        $existingConnection = Connection::where(function ($query) use ($authUserId, $receiverId) {
            $query->where('user_id', $authUserId)->where('connection_id', $receiverId);
        })->orWhere(function ($query) use ($authUserId, $receiverId) {
            $query->where('user_id', $receiverId)->where('connection_id', $authUserId);
        })->first();

        if ($existingConnection) {
            return redirect()->back()->with('error', 'A connection request already exists.');
        }

        // Create a new connection request
        Connection::create([
            'user_id' => $authUserId,
            'connection_id' => $receiverId,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Connection request sent.');
    }

    /**
     * Accept a connection request.
     */
    public function accept($connectionId)
    {
        $connection = Connection::where('id', $connectionId)
            ->where('status', 'pending')
            ->first();

        if (!$connection) {
            return redirect()->back()->with('error', 'Connection request not found.');
        }

        $connection->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Connection accepted.');
    }

    /**
     * Decline a connection request.
     */
    public function decline($connectionId)
    {
        $connection = Connection::where('user_id', $connectionId)
            ->where('connection_id', Auth::id())
            ->where('status', 'pending')
            ->first();
        // dd($connection);
        if (!$connection) {
            return redirect()->back()->with('error', 'Connection request not found.');
        }

        $connection->delete();

        return redirect()->back()->with('success', 'Connection request declined.');
    }

    /**
     * Remove an existing connection.
     */
    public function remove($connectionId)
    {
        $connection = Connection::where([
            ['user_id', Auth::id()], ['connection_id', $connectionId]
        ])->orWhere([
            ['user_id', $connectionId], ['connection_id', Auth::id()]
        ])->where('status', 'accepted')->first();
    
        if ($connection) {
            $connection->delete();
            return back()->with('success', 'Connection removed.');
        }
    
        return back()->with('error', 'Connection not found.');
    }
    
}
