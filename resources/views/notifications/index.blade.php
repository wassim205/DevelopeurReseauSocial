<x-app-layout>
    <section class="content bg-gray-900">
        <div class="container mx-auto p-6 max-w-4xl">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-100">Notifications</h1>
                @if($notifications->count() > 0)
                    <span class="px-3 py-1 bg-blue-900 text-blue-200 rounded-full text-sm font-medium">{{ $notifications->count() }} {{ $notifications->count() > 1 ? 'notifications' : 'notification' }}</span>
                @endif
            </div>
            
            @if($notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        @php
                            $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
                            $type = isset($data['commented_user']) ? 'comment' : (isset($data['liked_user']) ? 'like' : 'unknown');
                        @endphp
                    
                        <div class="notification-item bg-gray-800 rounded-lg border border-gray-700 p-4 transition hover:bg-gray-750">
                            <div class="flex items-start gap-4">
                                <!-- Icon based on notification type -->
                                @if($type == 'comment')
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-900 flex items-center justify-center text-blue-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                @elseif($type == 'like')
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-900 flex items-center justify-center text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="flex-1">
                                    @if($type == 'comment' && isset($data['commented_user']))
                                        <p class="font-medium text-gray-200">
                                            <span class="text-blue-400">{{ $data['commented_user']['name'] ?? 'Someone' }}</span> 
                                            {{ $data['message'] ?? 'commented on your post' }}
                                            @if(isset($data['post_title']))
                                                "<span class="font-semibold text-gray-100">{{ $data['post_title'] }}</span>"
                                            @endif
                                        </p>
                                        @if(isset($data['commented_message']))
                                            <div class="mt-2 p-3 bg-gray-700 rounded-md text-gray-300 text-sm border border-gray-600">
                                                "{{ $data['commented_message'] }}"
                                            </div>
                                        @endif
                                    @elseif($type == 'like' && isset($data['liked_user']))
                                        <p class="font-medium text-gray-200">
                                            <span class="text-red-400">{{ $data['liked_user']['name'] ?? 'Someone' }}</span> 
                                            {{ $data['message'] ?? 'liked your post' }}
                                            @if(isset($data['post_title']))
                                                "<span class="font-semibold text-gray-100">{{ $data['post_title'] }}</span>"
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-gray-300">{{ $data['message'] ?? 'Notification' }}</p>
                                        @if(isset($data['post_title']))
                                            <p class="text-gray-400 mt-1">{{ $data['post_title'] }}</p>
                                        @endif
                                    @endif
                                    
                                    <div class="mt-2 text-xs text-gray-400">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
{{--                                 
                                @if(!$notification->read_at)
                                    <div class="flex-shrink-0">
                                        <span class="w-3 h-3 bg-blue-400 rounded-full block"></span>
                                    </div>
                                @endif --}}
                                @if(!$notification->read_at)
                                <!-- Unread indicator -->
                                <div class="flex-shrink-0">
                                    <span class="w-3 h-3 bg-blue-400 rounded-full block"></span>
                                </div>
                
                                <!-- Button to mark as read -->
                                <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-sm text-blue-500">Mark as read</button>
                                </form>
                            @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination avec style dark -->
                <div class="mt-6 dark-pagination">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="bg-gray-800 rounded-lg border border-gray-700 p-8 text-center">
                    <div class="w-16 h-16 bg-gray-700 rounded-full mx-auto flex items-center justify-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-400">Vous n'avez pas de notifications pour l'instant.</p>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>