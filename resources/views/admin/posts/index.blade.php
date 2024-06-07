<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto p-8 bg-white overflow-hidden sm:rounded-lg">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="items-center justify-between lg:flex">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Noticias</h3>
                        <span class="text-base font-normal text-gray-900">Noticias publicadas</span>
                    </div>

                </div>

                <div class="flex flex-col mt-6">
                    <div class="inline-block min-w-full align-middle">
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <div class="d-flex justify-end py-2">
                            <a href="{{ route('admin.posts.new') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-sm border">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Agregar
                            </a>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercas">
                                        Titulo
                                    </th>
                                    <th class="p-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercas">
                                        Publicado Por
                                    </th>
                                    <th class="p-3 text-xs font-medium tracking-wider text-left text-gray-900 uppercas">
                                        Fecha de pulicacion
                                    </th>
                                    <th
                                        class="p-3 text-xs text-center font-medium tracking-wider text-gray-900 uppercas w-96">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="p-3 text-sm font-normal text-gray-900 whitespace-nowra">
                                            {{ $post->title }}
                                        </td>
                                        <td class="p-3 text-sm font-normal text-gray-900 whitespace-nowrap">
                                            {{ $post->user->name }}
                                        </td>
                                        <td class="p-3 text-sm font-semibold text-gray-900 whitespace-nowra">
                                            {{ $post->created_at->format('M j, Y') }}
                                        </td>
                                        <td class="p-3 text-sm font-normal text-gray-900 whitespace-nowrap text-center">
                                            <a href="{{ route('user.posts.show', $post->id) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-sm border">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.458 10C3.732 7.943 6.386 6 10 6s6.268 1.943 7.542 4c-1.274 2.057-3.928 4-7.542 4s-6.268-1.943-7.542-4zM10 4c-4.418 0-8 2.686-9.5 6 1.5 3.314 5.082 6 9.5 6s8-2.686 9.5-6c-1.5-3.314-5.082-6-9.5-6zm0 3a3 3 0 100 6 3 3 0 000-6zm0 4a1 1 0 110-2 1 1 0 010 2z">
                                                    </path>
                                                </svg>
                                                Ver
                                            </a>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-sm text-white bg-blue-600 hover:bg-blue-700">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                    </path>
                                                    <path fill-rule="evenodd"
                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Modificar
                                            </a>
                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="deletePost"
                                                    onclick="return confirm('Seguro que desea eliminar la publicacion?')"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-sm hover:bg-red-800">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
