@extends('layouts.auth')

@section('title', config('app.name').' | Annonces')
@section('main')
    <main class="relative px-24 -ml-3">
        <div class="px-3 mb-6">
            <h2 class="text-2xl font-bold text-gray-100">Gestion des annonces</h2>
        </div>
        <post-wrapper class="flex">
            <div class="w-2/3 px-3" slot="table" slot-scope="{selectPost}">
                <post-table :select-post="selectPost" @update="selectPost"></post-table>
            </div>
            <div class="w-1/3 px-3" slot="form" slot-scope="{ post }">
                <post-form :errors='@json($errors->toArray())' action="{{ route('posts.store') }}"
                           :categories='@json($categories)' :post="post">
                    @csrf
                </post-form>
            </div>
        </post-wrapper>
    </main>
@endsection
