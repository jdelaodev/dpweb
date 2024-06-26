<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden sm:rounded-lg">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <form action="#">
                    <div class="d-flex mt-4 w-100 border rounded-sm">
                            <div class="flex rounded-l-md w-100">
                                <input type="text" name="search_term" id="search_term" class="block flex-1 border-0 bg-transparent py-2 px-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{ $search_term }}" placeholder="Busqueda...">
                            </div>
                            <button type="submit" class="rounded-r-md bg-white px-2.5 text-sm font-semibold text-gray-900 hover:bg-gray-50  border-l">Buscar</button>
                    </div>
                </form>


                <div class="mx-auto grid grid-cols-1 gap-x-8 gap-y-16 lg:grid-cols-3 p-4">
                    @foreach ($posts as $post)
                        <article class="flex max-w-xl flex-col items-start justify-between py-3">
                            <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="2020-03-16" class="text-gray-500">{{ $post->created_at->format('M j, Y') }}</time>
                            <div class="d-flex">
                                @foreach ($post->categories as $category)
                                    <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100 d-block truncate">{{ $category->user_readable_name }}</a>
                                @endforeach
                                @if ($post->categories->count() > 2)
                                    <a class="relative z-10 rounded-ful px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100 d-block">+{{ $post->categories->count() - 2 }}</a>
                                @endif
                            </div>
                            </div>
                            <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="{{ route('user.posts.show', $post->id) }}">
                                <span class="absolute inset-0"></span>
                                {{ $post->title }}
                                </a>
                            </h3>
                            <p class="mt-3 line-clamp-3 text-sm leading-6 text-gray-600">{{ $post->content }}</p>
                            </div>
                            <div class="relative mt-3 flex items-center gap-x-4">
                                @if ($post->user->profile_image)
                                    <img src="{{ Storage::url($post->user->profile_image) }}" alt="Profile Image" class="h-10 w-10 rounded-full bg-gray-50">
                                @else
                                    <img src="{{ asset('img/default-user-image.png') }}" class="h-10 w-10 rounded-full bg-gray-50">
                                @endif
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                    <a href="#">
                                        <span class="absolute inset-0"></span>
                                        {{ $post->user->name }}
                                    </a>
                                    </p>
                                </div>
                            </div>
                        </article>
                      @endforeach                  
                  </div>
            </div>
        </div>
    </div>
</x-app-layout>
