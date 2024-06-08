<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden sm:rounded-lg">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="container mx-auto">
                    <div class="py-10">
                        <div class="pb-0">
                            @foreach ($post->categories as $category)
                                <span
                                    class="mb-5 inline-block rounded-full bg-gray-50 px-2 py-1 font-body text-sm text-green sm:mb-8">{{ $category->user_readable_name }}</span>
                            @endforeach
                            <h2 class="block font-body text-3xl font-semibold leading-tight sm:text-4xl md:text-5xl">
                                {{ $post->title }}
                            </h2>
                            <div class="flex items-center mt-5">
                                <div class="relative flex items-center gap-x-3">
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
                                <span class="vdark:text-white font-body text-gray-200 px-1">//</span>
                                <p class="pr-2 font-body text-gray-500 italic">
                                    {{ $post->created_at->format('M j, Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="pt-3">
                            <p>
                                {{ $post->content }}
                            </p>
                        </div>

                        <div class="text-sm text-gray-500">
                            <span>{{ $comments_count }} comments</span>
                            <span>-</span>
                            <form action="{{ route('posts.reactions.create', $post->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" name="reaction" value="like" class="border px-2 items-center inline disabled:opacity-75 {{ $current_user_reaction && $current_user_reaction->reaction_type->slug == 'like' ? 'bg-blue-700 text-white' : '' }}" :disabled="!Auth::user()">
                                    {{ $likes_count }} Likes
                                </button>
                                @method('POST')
                                <button type="submit" name="reaction" value="dislike" class="border px-2 items-center inline disabled:opacity-75 {{ $current_user_reaction && $current_user_reaction->reaction_type->slug == 'dislike' ? 'bg-blue-700 text-white' : '' }}" :disabled="!Auth::user()">
                                    {{ $dislikes_count }} Dislikes
                                </button>
                            </form>
                        </div>

                        <div class="pt-5">
                            <div class="p-4 bg-gray-100 rounded-t-sm">
                                <div class="flex items-center">
                                    <div class="relative flex items-center gap-x-3">
                                        @if (Auth::user() && Auth::user()->profile_image)
                                            <img src="{{ Storage::url(Auth::user()->profile_image) }}" alt="Profile Image" class="h-10 w-10 rounded-full bg-gray-50">
                                        @else
                                            <img src="{{ asset('img/default-user-image.png') }}" class="h-10 w-10 rounded-full bg-gray-50">
                                        @endif
                                        <div class="text-sm ms-1">
                                            <p class="font-semibold text-gray-900">
                                                <a href="#">
                                                    <span class="absolute inset-0"></span>
                                                    {{ Auth::user() ? Auth::user()->name : 'Desconocido' }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-14">
                                    <form action="{{ route('posts.comments.create', $post->id) }}" method="POST">
                                        @csrf

                                        <div class="mb-4">
                                            <textarea name="content" id="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-4 disabled:opacity-75"
                                                placeholder="Comentario" :disabled="!Auth::user()">{{ old('content') }}</textarea>
                                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                        </div>

                                        <div class="d-flex justify-end">
                                            <button type="submit"
                                                class=" border px-4 py-2 rounded-md ms-100 bg-white disabled:opacity-75" :disabled="!!!Auth::user()">Comentar</button>
                                        </div>

                                        <span class="text-gray-500 {{ Auth::user() ? 'invisible' : '' }}">Debe iniciar sesion para comentar.</span>
                                    </form>
                                </div>
                            </div>
                            @foreach ($comments as $comment)
                                <div class="border-l-4 mb-2 border-l-gray-100 p-4">
                                    <div class="flex items-center w-full">
                                        <div class="relative flex items-center gap-x-3">
                                            @if ($comment->user->profile_image)
                                                <img src="{{ Storage::url($comment->user->profile_image) }}" alt="Profile Image" class="h-10 w-10 rounded-full bg-gray-50">
                                            @else
                                                <img src="{{ asset('img/default-user-image.png') }}" class="h-10 w-10 rounded-full bg-gray-50">
                                            @endif
                                            <div class="text-sm ms-1">
                                                <p class="font-semibold text-gray-900 text-sm">
                                                    <a href="#">
                                                        <span class="absolute inset-0"></span>
                                                        {{ $comment->user->name }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <span class="vdark:text-white font-body text-gray-200 px-1 text-sm">//</span>
                                        <p class="pr-2 font-body text-gray-500 italic text-xs">
                                            {{ $comment->created_at->format('M j, Y g:ia') }}
                                        </p>

                                        @if (Auth::user() && Auth::user()->id == $comment->user->id)
                                            <form action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="deletePost"
                                                    class="inline-flex mx-2 items-center text-sm font-medium text-center text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="ms-14">
                                        <p class="text-sm">
                                            {{ $comment->content }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
