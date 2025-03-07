<?php
namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // $notifications = Auth::user()->notifications()->orderBy('read_at', 'desc')->latest()->paginate(10);
        $notifications = Auth::user()->notifications()
        ->orderByRaw('read_at IS NULL DESC') // Trier les non lues en premier (NULL signifie non lue)
        ->latest() // Trier par date de création, les plus récentes en premier
        ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
{
    $notification = Auth::user()->notifications()->findOrFail($id);

    // Mark the notification as read
    $notification->markAsRead();

    return back();
}

}