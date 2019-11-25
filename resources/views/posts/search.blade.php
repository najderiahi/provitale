@extends("layouts.guest")

@section('title', config('app.name').' | Recherche')

@section('main')
    <main class="px-6 sm:px-24 pt-12 mx-auto container lg:max-w-screen relative">
        <h2 class="text-2xl font-bold text-gray-700">Résultats de la recherche</h2>
        <section class="my-6">
            <div class="flex flex-wrap -mx-3">
                @if(isset($post) && !$posts->isEmpty())
                    @foreach($posts as $post)
                        <div class="w-full md:w-1/3 sm:w-1/2 px-3 mt-4">
                            @include('partials._complete-post', ['post' => $post])
                        </div>
                    @endforeach
                    <div class="my-4 mx-auto">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center mx-auto font-bold text-gray-600">Aucun résultat disponible</div>
                @endif
            </div>
        </section>
    </main>
@stop
