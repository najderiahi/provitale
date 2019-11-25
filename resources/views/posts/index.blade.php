@extends('layouts.guest')

@section('main')

    <main class="px-6 sm:px-24 pt-12 mx-auto container lg:max-w-screen relative">
        @if($posts->isEmpty())
            <div class="text-center mx-auto font-bold text-gray-600">Aucun post disponible</div>
        @else
            @foreach($posts as $category)
                @include('partials._category', ['category' => $category])
            @endforeach
        @endif
    </main>
@stop
