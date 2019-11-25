@extends('layouts.auth')

@section('title', config('app.name').' | Catégories')

@section('main')
    <main class="relative px-24 -ml-3">
        <div class="px-3 mb-6">
            <h2 class="text-2xl font-bold text-gray-100">Gestion des catégories</h2>
        </div>
        <category-wrapper class="flex">
            <div class="w-2/3 px-3" slot="table" slot-scope="{selectCategory}">
                <category-table :select-category="selectCategory" @update="selectCategory"></category-table>
            </div>
            <div class="w-1/3 px-3" slot="form" slot-scope="{ category }">
                <category-form :errors='@json($errors->toArray())' action="{{ route('categories.store') }}" :category="category">
                    @csrf
                </category-form>
            </div>
        </category-wrapper>
    </main>
@endsection
