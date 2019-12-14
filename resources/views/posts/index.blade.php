@extends('layouts.guest')

@section('main')
    <div class="h-5/6 flex relative"
         style="background-image: url('./assets/intro-background.jpg'); background-position: 50%, 20%; background-size: cover; background-repeat: no-repeat;">
        <div class="absolute w-full h-full flex justify-center items-center text-center"
             style="background-color: rgba(0, 0, 0, 0.4);">
            <h3 class="relative text-white text-6xl font-bold">Bienvenu à Provital !</h3>
        </div>
    </div>

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
