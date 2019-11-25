@extends("layouts.guest")

@section('title', config('app.name').' | Recherche')

@section('main')
    <main class="px-6 sm:px-24 pt-12 mx-auto container lg:max-w-screen relative">
        <h2 class="text-2xl font-bold text-gray-700">Résultats de la recherche</h2>
        <section class="my-6">
            @if(isset($posts) && !$posts->isEmpty())
            <div class="flex flex-wrap -mx-3">
                    @foreach($posts as $post)
                        <div class="w-full md:w-1/3 sm:w-1/2 px-3 mt-4">
                            @include('partials._complete-post', ['post' => $post])
                        </div>
                    @endforeach
            </div>
            <div class="my-8 mx-auto">
                {{ $posts->links("pagination::default") }}
            </div>
            @else
                <div class="text-center mx-auto font-bold text-gray-600">Aucun résultat disponible</div>
            @endif
        </section>
    </main>
@stop
