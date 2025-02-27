<x-app-layout>
    <div class="max-w-4xl mx-auto pt-20 px-6">
        <div class="bg-gray-800 rounded-xl shadow-sm p-6">
            <h2 class="text-2xl font-bold text-white mb-4">Create a New Post</h2>
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-gray-300 font-medium">Title</label>
                    <input type="text" name="title" required
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="content_type" class="block text-gray-300 font-medium">Content Type</label>
                    <select name="content_type" id="content_type"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"
                        onchange="toggleContentInput()">
                        <option value="link">Link</option>
                        <option value="code">Code</option>
                        <option value="image">Image</option>
                    </select>
                </div>

                <div id="content_input">
                    <label for="content" class="block text-gray-300 font-medium">Link</label>
                    <textarea name="content"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div id="code_input" style="display: none;">
                    <label for="content" class="block text-gray-300 font-medium">Code</label>
                    <textarea name="content"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div id="image_input" style="display: none;">
                    <label for="image" class="block text-gray-300 font-medium">Upload Image</label>
                    <input type="file" name="image"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="description" class="block text-gray-300 font-medium">Description</label>
                    <textarea name="description"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label for="project_link" class="block text-gray-300 font-medium">Project Link</label>
                    <input type="url" name="project_link"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="languages_used" class="block text-gray-300 font-medium">Languages Used</label>
                    <input type="text" name="languages_used"
                        class="w-full p-3 rounded-lg bg-gray-700 text-white border border-gray-600 focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-lg transition duration-200">Create
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
    </script>
</x-app-layout>
