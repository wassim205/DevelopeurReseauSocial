<x-app-layout>


    <div class="max-w-7xl mx-auto pt-20 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Profile Card -->
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <div class="h-24 bg-gradient-to-r from-blue-700 to-blue-500"></div>
                        <img src="https://avatar.iran.liara.run/public/boy" alt="Profile"
                            class="absolute -bottom-6 left-4 w-20 h-20 rounded-full border-4 border-gray-800 shadow-md" />
                    </div>
                    <div class="pt-14 p-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white">Sarah Connor</h2>
                            <a href="https://github.com" target="_blank" class="text-gray-400 hover:text-white">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                        </div>
                        <p class="text-gray-300 text-sm mt-1">Senior Full Stack Developer</p>
                        <p class="text-gray-400 text-sm mt-2">Building scalable web applications with modern
                            technologies</p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-600 text-white rounded-full text-xs">JavaScript</span>
                            <span class="px-2 py-1 bg-green-600 text-white rounded-full text-xs">Node.js</span>
                            <span class="px-2 py-1 bg-purple-600 text-white rounded-full text-xs">React</span>
                            <span class="px-2 py-1 bg-yellow-600 text-white rounded-full text-xs">Python</span>
                            <span class="px-2 py-1 bg-red-600 text-white rounded-full text-xs">Docker</span>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Connections</span>
                                <span class="text-blue-400 font-medium">487</span>
                            </div>
                            <div class="flex justify-between text-sm mt-2">
                                <span class="text-gray-400">Posts</span>
                                <span class="text-blue-400 font-medium">52</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="bg-gray-800 rounded-xl shadow-sm p-4">
                    <h3 class="font-semibold text-white mb-4">Trending Tags</h3>
                    <div class="space-y-2">
                        <a href="#" class="flex items-center justify-between hover:bg-gray-700 p-2 rounded">
                            <span class="text-gray-300">#javascript</span>
                            <span class="text-gray-400 text-sm">2.4k</span>
                        </a>
                        <a href="#" class="flex items-center justify-between hover:bg-gray-700 p-2 rounded">
                            <span class="text-gray-300">#react</span>
                            <span class="text-gray-400 text-sm">1.8k</span>
                        </a>
                        <a href="#" class="flex items-center justify-between hover:bg-gray-700 p-2 rounded">
                            <span class="text-gray-300">#webdev</span>
                            <span class="text-gray-400 text-sm">1.2k</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Feed -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Post Creation -->
                <div class="bg-gray-800 rounded-xl shadow-sm p-4">
                    <div class="flex items-center space-x-4">
                        <img src="https://avatar.iran.liara.run/public/boy" alt="User" class="w-12 h-12 rounded-full" />
                        <button
                            class="bg-gray-700 hover:bg-gray-600 text-gray-300 text-left rounded-lg px-4 py-3 flex-grow transition-colors duration-200">
                            Share your knowledge or ask a question...
                        </button>
                    </div>
                    <div class="flex justify-between mt-4 pt-4 border-t border-gray-700">
                        <button class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            <span>Code</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Image</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-300 hover:text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span>Link</span>
                        </button>
                    </div>
                </div>

                <!-- Posts -->
                <div class="bg-gray-800 rounded-xl shadow-sm">
                    <div class="p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="https://avatar.iran.liara.run/public/boy" alt="User"
                                    class="w-10 h-10 rounded-full" />
                                <div class="ml-3">
                                    <h3 class="text-white">John Doe</h3>
                                    <p class="text-gray-400 text-sm">2 hours ago</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h10m-5 4h5" />
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-gray-300">Check out this cool article on web development best practices!</p>
                        <div class="mt-4 bg-gray-900 rounded-lg p-4 font-mono text-sm text-gray-200">
                            <pre><code>
        const redis = require('redis');
        const client = redis.createClient();
        
        async function getCachedData(key) {
          const cached = await client.get(key);
          if (cached) {
            return JSON.parse(cached);
          }
          
          const data = await fetchDataFromDB();
          await client.setEx(key, 3600, JSON.stringify(data));
          return data;
        }
                            </code></pre>
                        </div>
                        <div class="flex justify-between mt-4 border-t border-gray-700 pt-4">
                            <button class="flex items-center text-gray-400 hover:text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h10m-5 4h5" />
                                </svg>
                                <span class="ml-2">25 Comments</span>
                            </button>
                            <button class="flex items-center text-gray-400 hover:text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 21l-8-8h16zM4 11V4a2 2 0 012-2h12a2 2 0 012 2v7" />
                                </svg>
                                <span class="ml-2">Like</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>