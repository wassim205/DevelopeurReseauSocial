<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->user()->id ?? '' }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Include Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .toast-info {
            @apply bg-gray-800 border-l-4 border-blue-500 text-gray-200 rounded-md shadow-lg;
            width: 380px !important;
            padding: 0 !important;
            backdrop-filter: blur(12px);
            background-color: rgba(31, 41, 55, 0.95);
        }

        #toast-container>.toast-info {
            opacity: 1;
        }

        .toast-close-button {
            @apply text-gray-400 opacity-80;
            top: 8px;
            right: 8px;
            text-shadow: none;
            transition: all 0.2s ease;
        }

        .toast-close-button:hover {
            @apply text-gray-300 opacity-100 rotate-90;
        }

        .toast-progress {
            @apply bg-blue-500;
            opacity: 0.7;
            height: 3px;
        }

        .toast-title {
            @apply pb-1.5 pt-2.5 px-4 text-xs text-blue-400 font-semibold border-b border-gray-700/50;
            letter-spacing: 0.5px;
        }

        .toast-message {
            @apply p-3;
        }

        /* Animation for the notification */
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        #toast-container>.toast {
            animation: slideIn 0.3s ease forwards;
        }
    </style>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });
        var auth_user = document.querySelector('meta[name="user-id"]')?.getAttribute('content');
        var channel = pusher.subscribe('notification');
        channel.bind('comment.notification', function (data) {
            console.log(data);
            if (data.message) {
                if (auth_user && parseInt(auth_user) === parseInt(data.post_owner_id)) {
                    toastr.info(
                        `<div class="p-4 space-y-3"> 
                                <div class="flex w-full overflow-hidden space-x-3"> 
                                    <div class="flex-shrink-0">
                                        <div class="bg-gradient-to-br from-blue-600/20 to-blue-900/30 rounded-full p-3 flex items-center justify-center ring-1 ring-blue-500/20">
                                            <i class="fas fa-comment-dots text-blue-400 text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow space-y-2">
                                        <div class="text-gray-100 text-sm leading-tight">
                                            <span class="font-semibold text-blue-400">${data.commented_user['name']}</span> 
                                            <span>${data.message}</span>
                                        </div>
                                        <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                                            <div class="flex items-start text-xs text-gray-400 group">
                                                <i class="fas fa-quote-left mr-2 text-gray-500 mt-0.5"></i>
                                                <span class="truncate group-hover:text-gray-300 transition-colors">${data.commented_message}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-start text-xs text-gray-400 group">
                                            <i class="fas fa-file-alt mr-2 text-gray-500 mt-0.5"></i>
                                            <span class="truncate group-hover:text-gray-300 transition-colors">${data.post_title}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`,
                        `<div class="px-4 py-2 text-blue-400 font-semibold text-sm">New Comment</div>`,
                        {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 8000,
                            extendedTimeOut: 2000,
                            positionClass: 'toast-top-right',
                            enableHtml: true
                        }
                    );


                }
            } else {
                console.error('Invalid data received:', data);
            }
        });

        // likes notification
        channel.bind('like.notification', function (data) {
            console.log(data);
            if (data.message) {
                if (auth_user && parseInt(auth_user) === parseInt(data.post_owner_id)) {
                    toastr.info(
                        `<div class="p-4 space-y-3"> 
                            <div class="flex w-full overflow-hidden space-x-3"> 
                                <div class="flex-shrink-0">
                                    <div class="bg-gradient-to-br from-blue-600/20 to-blue-900/30 rounded-full p-3 flex items-center justify-center ring-1 ring-blue-500/20">
                                        <i class="fas fa-thumbs-up text-blue-400 text-lg"></i>
                                    </div>
                                </div>
                                <div class="flex-grow space-y-2">
                                    <div class="text-gray-100 text-sm leading-tight">
                                        <span class="font-semibold text-blue-400">${data.liked_user['name']}</span> 
                                        <span>${data.message}</span>
                                    </div>
                                    <div class="bg-gray-800 p-3 rounded-md border border-gray-700">
                                        <div class="flex items-start text-xs text-gray-400 group">
                                            <i class="fas fa-thumbs-up mr-2 text-gray-500 mt-0.5"></i>
                                            <span class="truncate group-hover:text-gray-300 transition-colors">${data.post_title}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`,
                        `<div class="px-4 py-2 text-blue-400 font-semibold text-sm">New Like</div>`,

                        {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 8000,
                            extendedTimeOut: 2000,
                            positionClass: 'toast-top-right',
                            enableHtml: true
                        }
                    );


                }
            } else {
                console.error('Invalid data received:', data);
            }
        });

        pusher.connection.bind('connected', function () {
            console.log('Pusher connected');
        });
    </script>
</body>

</html>