@extends('layouts.guest')

@section('main')
    <div class="h-screen">
        <div class="container mx-auto px-6 sm:px-0">
            <h3 class="my-12 text-3xl font-bold">{{ $category->name }}</h3>
            <div class="flex -mx-3">
                @forelse($posts as $post)
                    <div class="w-full md:w-1/3 sm:w-1/2 px-3 my-2">
                        <post-component image="{{ $post->url }}" description="{{ $post->description }}"></post-component>
                    </div>
                @empty
                    <div class="px-3 font-bold text-gray-600">Pas de posts dans cette catégorie</div>
                @endforelse
            </div>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
