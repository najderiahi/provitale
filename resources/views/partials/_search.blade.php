<form action="{{ route('search') }}" method="GET" class="flex flex-wrap items-center sm:flex-no-wrap justify-between xl:justify-start">
    <div class="xl:mx-4 mt-4 sm:mt-0 inline-flex items-center justify-start xl:ml-8 relative bg-gray-800 xl:bg-gray-700 px-3 py-2 rounded w-full sm:w-auto">
        <svg class="w-5 h-5 fill-current text-gray-400 mr-2 flex-shrink-0" viewBox="0 0 20 20">
            <path
                d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
        </svg>
        <input type="search" class="bg-transparent text-white max-w-md w-full overflow-hidden flex-shrink"
               placeholder="Recherchez des mots-clés" name="query">
    </div>
    <toggle-component class="w-full sm:w-auto my-3 xl:mx-4">
        <div slot="trigger" slot-scope="{ toggle }" class="w-full">
            <button type="button" @click="toggle"
                    class="flex justify-center items-center text-gray-400 bg-gray-600 xl:bg-gray-900 px-4 py-2 shadow rounded w-full">
                <svg class="w-4 h-4 fill-current mx-1" viewBox="0 0 20 20">
                    <path
                        d="M17 16v4h-2v-4h-2v-3h6v3h-2zM1 9h6v3H1V9zm6-4h6v3H7V5zM3 0h2v8H3V0zm12 0h2v12h-2V0zM9 0h2v4H9V0zM3 12h2v8H3v-8zm6-4h2v12H9V8z"/>
                </svg>
                <span class="text-white">Filtres</span>
            </button>
        </div>
        <div slot="toggleable" slot-scope="{ isOpen, close }">
            <div class="absolute w-84 top-0 left-0 bottom-0 z-40 bg-gray-900 h-screen" v-show="isOpen">
                <button type="button" class="absolute right-0 mr-6 mt-6" @click="close">
                    <svg class="w-5 h-5 fill-current text-gray-400 hover:text-white" viewBox="0 0 20 20">
                        <path
                            d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/>
                    </svg>
                </button>
                <div class="px-6">
                    <div class="overflow-y-auto">
                        <h2 class="text-gray-400 mt-12 text-2xl">Filtres</h2>
                        @if(isset($categories) && !$categories->isEmpty())
                            <div class="mt-4 mb-2 border-b border-gray-700 pb-6">
                                <span class="text-gray-600 text-sm tracking-wide uppercase font-bold">Catégories</span>
                                <div class="mt-2">
                                    @foreach($categories as $category)
                                        <label class="inline-flex items-center py-2">
                                            <input type="checkbox" class="form-checkbox" name="category[]"
                                                   value="{{ $category->name }}">
                                            <span class="ml-2 text-white">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mt-4">
                            <span class="text-gray-600 text-sm tracking-wide uppercase font-bold">Chronologie</span>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="sort" value="oldest">
                                    <span class="ml-2 text-white">Ancien</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" class="form-radio" name="sort" value="latest" checked>
                                    <span class="ml-2 text-white">Récent</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="-px-6 px-6 py-3 absolute bottom-0 left-0 right-0 bg-gray-800">
                        <button class="text-white bg-indigo-800 py-2 text-center w-full rounded">Rechercher</button>
                    </div>
                </div>
            </div>
        </div>
    </toggle-component>
</form>
