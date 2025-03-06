<x-app-layout>
    <div class="max-w-4xl mx-auto pt-20 px-6">
        <div class="mt-4">
            @if(session('success'))
                <div class="alert alert-success p-3 mb-4 rounded bg-green-100 text-green-800 border border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Alert -->
            @if($errors->any())
                <div class="alert alert-error p-3 mb-4 rounded bg-red-100 text-red-800 border border-red-200">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
        <div class="bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-2xl font-bold text-white mb-4">Edit Post</h2>
            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="title" class="block text-gray-300 font-medium">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="content_type" class="block text-gray-300 font-medium">Content Type</label>
                    <select name="content_type" id="content_type"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"
                        onchange="toggleContentInput()">
                        <option value="link" {{ $post->content_type == 'link' ? 'selected' : '' }}>Link</option>
                        <option value="code" {{ $post->content_type == 'code' ? 'selected' : '' }}>Code</option>
                        <option value="image" {{ $post->content_type == 'image' ? 'selected' : '' }}>Image</option>
                    </select>
                </div>

                <div id="content_input" style="display: {{ $post->content_type == 'link' ? 'block' : 'none' }};">
                    <label for="content" class="block text-gray-300 font-medium">Link</label>
                    <textarea name="content"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">{{ old('content', $post->content) }}</textarea>
                </div>

                <div id="code_input" style="display: {{ $post->content_type == 'code' ? 'block' : 'none' }};">
                    <label for="content" class="block text-gray-300 font-medium">Code</label>
                    <textarea name="content"
                        class="w-full h-52 p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">{{ old('content', $post->content) }}</textarea>
                </div>

                <div id="image_input" style="display: {{ $post->content_type == 'image' ? 'block' : 'none' }};">
                    <label for="image" class="block text-gray-300 font-medium">Upload Image</label>
                    <input type="file" name="image"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-gray-300 font-medium">Description</label>
                    <textarea name="description"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">{{ old('description', $post->description) }}</textarea>
                </div>

                <div>
                    <label for="project_link" class="block text-gray-300 font-medium">Project Link</label>
                    <input type="url" name="project_link" value="{{ old('project_link', $post->project_link) }}"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="languages_used" class="block text-gray-300 font-medium">Languages Used</label>
                    <input type="text" name="languages_used" value="{{ old('languages_used', $post->languages_used) }}"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
    <label for="hashtags" class="block text-gray-300 font-medium">Hashtags</label>
    <input type="text" name="hashtags" 
        value="{{ old('hashtags', implode(' ', $post->hashtags->pluck('name')->toArray())) }}" 
        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"
        placeholder="#javascript #react #webdev">
</div>
                

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg transition duration-200">Update
                    Post</button>
            </form>
        </div>
    </div>

    <script>
        function toggleContentInput() {
            var contentType = document.getElementById('content_type').value;
            document.getElementById('content_input').style.display = contentType === 'link' ? 'block' : 'none';
            document.getElementById('code_input').style.display = contentType === 'code' ? 'block' : 'none';
            document.getElementById('image_input').style.display = contentType === 'image' ? 'block' : 'none';
        }

        // Run on page load to handle the content type selected during page load
        document.addEventListener('DOMContentLoaded', function () {
            toggleContentInput();
        });
    </script>
</x-app-layout>
