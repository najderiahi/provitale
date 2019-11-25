@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 h-screen">
        <header class="h-64 bg-indigo-800 relative">
            <nav class=" px-6 sm:px-24 pt-6 flex items-center justify-between">
                <div class="flex items-center w-84 justify-between">
                    <a href="/" class="block pr-8 border-r border-gray-600"><h2 class="text-2xl font-bold text-white">Provitale<span
                                class="text-3xl text-indigo-300">.</span></h2></a>
                    @include('partials._search')
                </div>
                @guest
                    <a href="{{ route('login') }}"
                       class="text-white px-4 py-2 border border-white rounded hover:bg-white hover:text-indigo-800 block ml-6">Se connecter</a>
                @else
                    <toggle-component class="relative">
                        <div slot="trigger" slot-scope="{ toggle }">
                        <a @click.prevent="toggle"
                           class="text-white hover:underline text-bold ml-6 cursor-pointer">{{ Auth::user()->name }}</a>
                        </div>
                        <div slot="toggleable" slot-scope="{ isOpen, close }">
                            <div class="fixed inset-0 bg-transparent" v-show="isOpen" @click="close"></div>
                            <div  class="absolute bg-white py-3 rounded shadow-lg -ml-5" v-show="isOpen">
                            <a href="{{ route('home') }}" class="block px-6 py-1 hover:text-white hover:bg-indigo-600">Annonces</a>
                            <a href="{{ route('categories') }}" class="block px-6 py-1 hover:text-white hover:bg-indigo-600">Catégories</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="px-6 py-1 hover:text-white hover:bg-indigo-600">Déconnexion</button>
                            </form>
                            </div>
                        </div>
                    </toggle-component>
                @endif
            </nav>
        </header>
        @yield('main')
    </div>
@stop
