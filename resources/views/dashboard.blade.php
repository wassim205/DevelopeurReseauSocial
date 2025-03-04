<x-app-layout>

   

    <div class="max-w-7xl mx-auto pt-20 px-4">

       
        
        <div class="mt-4">
            @if(session('success'))
                <div
                    class="alert alert-success p-3 mb-4 rounded bg-green-100 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif
    
            <!-- Error Alert -->
            @if($errors->any())
                <div
                    class="alert alert-error p-3 mb-4 rounded bg-red-100 text-red-800 border border-red-200">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
        <!-- Conteneur pour les résultats de recherche -->
        <div id="search-results-container" class="max-w-7xl mx-auto pt-4 px-4 hidden">
            <div class="bg-gray-800 rounded-xl p-4 mb-6">
                <h2 class="text-xl font-bold text-white mb-4">Search Results</h2>
                <div id="search-results" class="space-y-4"></div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- Profile Card -->
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <div class="h-24 bg-gradient-to-r from-blue-700 to-blue-500"></div>
                        @if (auth()->user()->githubProfile)
                        <img src="https://github.com/{{ auth()->user()->githubProfile }}.png" alt="Profile"
                            class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-gray-800 shadow-md" />
                        @else
                        <img src="https://avatar.iran.liara.run/public/boy" alt="Profile"
                            class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-gray-800 shadow-md" />
                        @endif
                    </div>
                    <div class="pt-14 p-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white">{{ auth()->user()->username }}</h2>
                            <a href="https://github.com/{{ auth()->user()->githubProfile }}" target="_blank" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-gray-300 text-sm mt-1">{{ auth()->user()->proficiency ?? '' }}</p>
                        <p class="text-gray-400 text-sm mt-2">{{ auth()->user()->biography }}</p>

                        @if (auth()->user()->skills && is_array(auth()->user()->skills))
                        <div class="mt-4 flex flex-wrap gap-2">
                            @php
                                // Define the color classes
                                $colors = [
                                    'bg-red-600',
                                    'bg-blue-600',
                                    'bg-green-600',
                                    'bg-purple-600',
                                    'bg-yellow-600',
                                ];
                            @endphp
                            @foreach(auth()->user()->skills as $index => $skill)
                                <span class="px-2 py-1 {{ $colors[$index % count($colors)] }} text-white rounded-full text-xs">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                    

                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Connections</span>
                                <span class="text-blue-400 font-medium">487</span>
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-gray-400">Posts</span>
                                <span class="text-blue-400 font-medium">{{ auth()->user()->posts()->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="bg-gray-800 rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold text-white mb-4">Trending Tags</h3>
                    <div class="space-y-2">
                        @foreach($trendingTags as $tag)
                            <p class="flex items-center justify-between hover:bg-gray-700 p-2 rounded">
                                <span class="text-gray-300">{{ $tag->name }}</span>
                                <span class="text-gray-400 text-sm">{{ $tag->posts_count }}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
                
            </div>

            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Post Creation -->
                <div class="bg-gray-800 rounded-xl shadow-sm p-4">
                    <div class="flex items-center space-x-4">
                        {{-- <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full" /> --}}

                        @if(auth()->user()->githubProfile)
                            <img src="https://github.com/{{ auth()->user()->githubProfile }}.png" alt="Photo de profil"
                                class="w-12 h-12 rounded-full" loading="lazy" />
                        @else
                            <img src="https://avatar.iran.liara.run/public/boy" alt="Photo de profil"
                                class="w-12 h-12 rounded-full" loading="lazy" />
                        @endif
                        
                        <a href="{{ route('posts.create', ['content_type' => 'code']) }}"
                            class="bg-gray-700 hover:bg-gray-600 text-gray-300 text-left rounded-lg px-4 py-3 flex-grow transition-colors duration-200">
                            Share your knowledge or ask a question...
                        </a>
                    </div>
                    <div class="flex justify-between mt-4 pt-4 border-t border-gray-700">
                        <a href="{{ route('posts.create', ['content_type' => 'code']) }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            <span>Code</span>
                        </a>
                        <a href="{{ route('posts.create', ['content_type' => 'image']) }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Image</span>
                        </a>
                        <a href="{{ route('posts.create', ['content_type' => 'link']) }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            <span>Link</span>
                        </a>
                    </div>
                </div>

            {{-- POSTS --}}
                @foreach($posts as $post)
                <div class="bg-gray-800 rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                               
                                @if($post->user->githubProfile)
                            <img src="https://github.com/{{ $post->user->githubProfile }}.png" alt="Photo de profil"
                                class="w-10 h-10 rounded-full" loading="lazy" />
                        @else
                            <img src="https://avatar.iran.liara.run/public/boy" alt="Photo de profil"
                                class="w-10 h-10 rounded-full" loading="lazy" />
                        @endif
                                <div class="ml-3">
                                    <h3 class="text-white">{{ $post->user->username }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-5 4h5" />
                                </svg>
                            </button>
                        </div>
                        
                        <p class="mt-2 text-gray-300">{{ $post->title }}</p>
                       @if($post->description) 
                       <p class="mt-2 text-gray-300">{{ $post->description }}</p>
                       @endif
                      
                        <div class="flex flex-wrap mt-2">
                            @if ($post->hashtags->isNotEmpty())
                                @foreach ($post->hashtags as $hashtag)
                                    <p
                                    class="bg-gray-700 text-gray-300 rounded px-2 py-1 mr-2 mt-1 hover:bg-gray-600">
                                        {{ $hashtag->name }}
                                    </p>
                                @endforeach
                            @endif
                        </div>
                        
                        @switch($post->content_type)
                            @case('image')
                                <div class="mt-4">
                                    <img src="{{Storage::url($post->content)}}" alt="" class="border-rounded rounded-sm" loading="lazy">
                                </div>
                                @break
                
                            @case('link')
                                <a href="{{ $post->project_link }}" target="_blank" class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Visit Link</a>
                                @break
                
                            @case('code')
                            <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200 overflow-x-auto">
                                <pre><code class="whitespace-pre-wrap">{{ $post->content }}</code></pre>
                            </div>
                            
                                @break
                        @endswitch
                        
                        <div class="flex justify-between mt-4 border-t border-gray-700 pt-4">
                            <button class="flex items-center text-gray-400 hover:text-blue-500" onclick="toggleComments({{ $post->id }})">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <span class="ml-2">{{ $post->comments->count() }} Comment{{ $post->comments->count() != 1 ? 's' : '' }}</span>
                            </button>
                        
                            <button id="like-button-{{ $post->id }}" data-post-id="{{ $post->id }}"
                                class="flex items-center {{ $post->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}"
                                onclick="likePost({{ $post->id }})">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                </svg>
                                <span class="ml-2">{{ $post->likes->count() }} Like{{ $post->likes->count() != 1 ? 's' : '' }}</span>
                            </button>
                        </div>
                        
                        <div id="comment-section-{{ $post->id }}" class="mt-4 hidden">
                        
                            <form id="comment-form-{{ $post->id }}" class="mb-4" onsubmit="submitComment(event, {{ $post->id }})">
                                @csrf
                                <div class="flex items-start">
                                   
                                    @if (auth()->user()->githubProfile)
                                    <img src="https://github.com/{{  auth()->user()->githubProfile }}.png" alt="Avatar"
                                        class="w-8 h-8 rounded-full" loading="lazy" />
                                    @else
                                    <img src="https://avatar.iran.liara.run/public/boy" alt="Avatar"
                                        class="w-8 h-8 rounded-full" loading="lazy" />
                                    @endif
                                    <div class="ml-2 flex-grow">
                                        <textarea name="content" placeholder="Ajouter un commentaire..." class="w-full bg-gray-700 text-gray-200 p-2 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 resize-none"></textarea>
                                        <button type="submit" class="mt-2 px-4 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded-md text-sm transition duration-200">Publier</button>
                                    </div>
                                </div>
                            </form>
                            
                      
                            <div id="comments-container-{{ $post->id }}" class="space-y-3 pl-2">
                                @foreach ($post->comments as $comment)
                                    <div class="flex items-start">
                                      
                                        @if ( $comment->user->githubProfile)
                                        <img src="https://github.com/{{  $comment->user->githubProfile }}.png" alt="Avatar"
                                            class="w-8 h-8 rounded-full" loading="lazy" />
                                        @else
                                        <img src="https://avatar.iran.liara.run/public/boy" alt="Avatar"
                                            class="w-8 h-8 rounded-full" loading="lazy" />
                                        @endif
                                        <div class="ml-2 bg-gray-700 p-3 rounded-lg flex-grow">
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-200">{{ $comment->user->username }}</span>
                                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-300 mt-1">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        <div>
            <div class="bg-gray-800 rounded-xl shadow-sm p-4">
                <h3 class="text-xl font-bold text-white mb-4">Connections</h3>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="Connection"
                            class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="text-white font-medium">Alice Johnson</p>
                            <p class="text-gray-400 text-sm">UI/UX Designer</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="Connection"
                            class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="text-white font-medium">Bob Williams</p>
                            <p class="text-gray-400 text-sm">Backend Developer</p>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="Connection"
                            class="w-10 h-10 rounded-full" />
                        <div class="ml-3">
                            <p class="text-white font-medium">Catherine Lee</p>
                            <p class="text-gray-400 text-sm">Project Manager</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
                        
    <script>
        function toggleComments(postId) {
                const commentSection = document.getElementById(`comment-section-${postId}`);
                commentSection.classList.toggle('hidden');
            }

            function likePost(postId) {
                fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    const likeButton = document.getElementById(`like-button-${postId}`);
                    const likeCount = likeButton.querySelector('span');
                    likeCount.textContent = `${data.count} ${data.count !== 1 ? 'Likes' : 'Like'}`;

                    likeButton.classList.toggle('text-blue-500', data.liked);
                    likeButton.classList.toggle('text-gray-400', !data.liked);
                });
            }

            function submitComment(event, postId) {
                event.preventDefault();
                const form = document.getElementById(`comment-form-${postId}`);
                const formData = new FormData(form);

                fetch(`/posts/${postId}/comments`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const commentsContainer = document.getElementById(`comments-container-${postId}`);

                    const commentElement = document.createElement('div');
                    commentElement.className = 'flex items-start';
                    commentElement.innerHTML = `
                        <img src="https://github.com/${data.user.githubProfile}.png" alt="Avatar" class="w-8 h-8 rounded-full">
                        <div class="ml-2 bg-gray-700 p-3 rounded-lg flex-grow">
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-200">${data.user.username}</span>
                                <span class="text-xs text-gray-400">just now</span>
                            </div>
                            <p class="text-gray-300 mt-1">${data.content}</p>
                        </div>
                    `;

                    commentsContainer.prepend(commentElement);
                    form.reset();

                    const commentButton = document.querySelector(`button[onclick="toggleComments(${postId})"] span`);
                    const count = parseInt(commentButton.textContent.split(' ')[0]) + 1;
                    commentButton.textContent = `${count} ${count !== 1 ? 'Comments' : 'Comment'}`;
                });
            }
           


         document.getElementById("search-form").addEventListener("submit", async function(e) {
    e.preventDefault();
    const query = this.querySelector('[name="query"]').value.trim();
    const resultsContainer = document.getElementById("search-results");
    const resultsWrapper = document.getElementById("search-results-container");
    const mainContent = document.querySelector('.grid.grid-cols-1.gap-6');

    if (!query) {
        resultsWrapper.classList.add('hidden');
        mainContent.classList.remove('hidden');
        return;
    }

    resultsWrapper.classList.remove('hidden');
    mainContent.classList.add('hidden');
    resultsContainer.innerHTML = '<p class="text-gray-400 px-4 py-2">Searching posts...</p>';
    function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

    try {
        const response = await fetch(`/search?query=${encodeURIComponent(query)}`);
        if (!response.ok) throw new Error(response.statusText);
        const data = await response.json();
        console.log(data);
        
        if (data.posts.length > 0) {
            const postsHtml = data.posts.map(post => {
    const userProfile = post.user.githubProfile 
        ? `https://github.com/${post.user.githubProfile}.png`
        : "https://avatar.iran.liara.run/public/boy";
    
    const comments = Array.isArray(post.comments) ? post.comments : [];
    const likes = Array.isArray(post.likes) ? post.likes : [];
                console.log(post.content);
    return `
        <div class="bg-gray-800 rounded-xl shadow-sm">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                              @if($post->user->githubProfile)
                            <img src="https://github.com/{{ $post->user->githubProfile }}.png" alt="Photo de profil"
                                class="w-10 h-10 rounded-full" loading="lazy" />
                        @else
                            <img src="https://avatar.iran.liara.run/public/boy" alt="Photo de profil"
                                class="w-10 h-10 rounded-full" loading="lazy" />
                        @endif
                        <div class="ml-3">
                            <h3 class="text-white">{{ $post->user->username }}</h3>
                            <p class="text-gray-400 text-sm">${new Date(post.created_at).toLocaleDateString()}</p>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-5 4h5" />
                        </svg>
                    </button>
                </div>
                
                <p class="mt-2 text-gray-300">${post.title}</p>
                ${post.description ? `<p class="mt-2 text-gray-300">${post.description}</p>` : ''}

                <div class="flex flex-wrap mt-2">
                    ${post.hashtags.map(hashtag => `
                        <p class="bg-gray-700 text-gray-300 rounded px-2 py-1 mr-2 mt-1 hover:bg-gray-600">
                            ${hashtag.name}
                        </p>
                    `).join('')}
                </div>

                ${post.content_type === 'image' ? `
                    <div class="mt-4">
                        <img src="${post.content}" alt="" class="border-rounded rounded-sm" loading="lazy">
                    </div>` 
                : post.content_type === 'link' ? `
                    <a href="${post.project_link}" target="_blank" class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Visit Link</a>` 
                : post.content_type === 'code' ? `
                    <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200 overflow-x-auto">
                                <pre><code class="whitespace-pre-wrap">${escapeHtml(post.content)}</code></pre>
                            </div>` 
                : ''}

                <div class="flex justify-between mt-4 border-t border-gray-700 pt-4">
                    <button class="flex items-center text-gray-400 hover:text-blue-500" onclick="toggleComments(${post.id})">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <span class="ml-2">${comments.length} Comment${comments.length !== 1 ? 's' : ''}</span>
                    </button>

                    <button id="like-button-${post.id}" data-post-id="${post.id}"
                        class="flex items-center {{ $post->isLikedBy(auth()->user()) ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}"
                        onclick="likePost(${post.id})">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span class="ml-2">${likes.length} Like${likes.length !== 1 ? 's' : ''}</span>
                    </button>
                </div>

                <div id="comment-section-${post.id}" class="mt-4 hidden">
                    <form id="comment-form-${post.id}" class="mb-4" onsubmit="submitComment(event, ${post.id})">
                        <div class="flex items-start">

                            <div class="ml-2 flex-grow">
                                <textarea name="content" placeholder="Ajouter un commentaire..." class="w-full bg-gray-700 text-gray-200 p-2 border border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 resize-none"></textarea>
                                <button type="submit" class="mt-2 px-4 py-1 text-white bg-blue-500 hover:bg-blue-600 rounded-md text-sm transition duration-200">Publier</button>
                            </div>
                        </div>
                    </form>

                    <div id="comments-container-${post.id}" class="space-y-3 pl-2">
                        ${comments.map(comment => `
                            <div class="flex items-start">
                                 @if ( $comment->user->githubProfile)
                                        <img src="https://github.com/{{  $comment->user->githubProfile }}.png" alt="Avatar"
                                            class="w-8 h-8 rounded-full" loading="lazy" />
                                        @else
                                        <img src="https://avatar.iran.liara.run/public/boy" alt="Avatar"
                                            class="w-8 h-8 rounded-full" loading="lazy" />
                                        @endif
                                <div class="ml-2 bg-gray-700 p-3 rounded-lg flex-grow">
                                    <div class="flex justify-between">
                                        
                                        <div class="ml-2 bg-gray-700 p-3 rounded-lg flex-grow">
                                            <div class="flex justify-between">
                                                <span class="font-medium text-gray-200">{{ $comment->user->username }}</span>
                                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-300 mt-1">{{ $comment->content }}</p>
                                        </div>
                                      
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        </div>
    `;
}).join('');

            resultsContainer.innerHTML = postsHtml;
        } else {
            resultsContainer.innerHTML = '<p class="text-gray-400 px-4 py-2">No posts found matching your search.</p>';
        }
    } catch (error) {
        console.error("Search error:", error);
        resultsContainer.innerHTML = '<p class="text-red-400 px-4 py-2">Failed to load search results. Please try again.</p>';
    }
});
    </script>

</x-app-layout>