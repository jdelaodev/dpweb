<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden sm:rounded-lg">
            <div class="bg-white overflow-hidden sm:rounded-lg py-4">
                <form action="{{ $post->id ? route('admin.posts.update', $post->id) : route('admin.posts.create') }}" method="POST">
                    @csrf
                    @method($post->id ? 'PUT' : 'POST')

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Titulo</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                         <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Contenido</label>
                        <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $post->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-sm font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Guardar</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
