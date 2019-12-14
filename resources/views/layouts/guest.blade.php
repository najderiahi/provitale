@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 h-screen">
        <header class="bg-gray-800 relative">
            <nav class=" px-6 sm:px-24 py-6 md:flex md:items-center md:justify-between">
                <a href="/" class="block sm:pr-8"><h2
                        class="text-2xl font-bold text-white">{{ config('app.name') }}</h2></a>
                <div class="hidden xl:block">
                    @include('partials._search')
                </div>
                <button class="text-white md:invisible ml-auto">
                    <svg class="fill-current w-6 h-6" viewBox="0 0 20 20">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
                <ul class="block md:inline-block ml-auto md:flex md:items-center md:justify-between">
                    <li class="md:mx-4">
                        <a href="/" class="text-white">Accueil</a></li>
                    <li class="md:mx-4 my-2">
                        <toggle-component class="relative">
                            <div slot="trigger" slot-scope="{ toggle }"
                                 class="sm:border-0 sm:pt-0">
                                <a @click.prevent="toggle"
                                   class="text-white flex items-center flex-no-wrap cursor-pointer">
                                    Catégories
                                    <svg class="fill-current w-4 h-4" viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </a>
                            </div>
                            <div slot="toggleable" slot-scope="{ isOpen, close }">
                                <div class="fixed inset-0 bg-red z-50" v-show="isOpen" @click="close"></div>
                                <div class="absolute bg-gray-700 py-3 rounded shadow-lg z-50 mt-2" v-show="isOpen">
                                    @foreach($categories as $category)
                                        <a href="{{ route('home') }}"
                                           class="block px-6 py-1 text-white hover:text-gray-300">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </toggle-component>
                    </li>
                    <li class="md:mx-4 my-2"><a href="" class="text-white">Contact</a></li>
                    <li class="md:mx-4 my-2"><a href="" class="text-white">À propos</a></li>
                </ul>
                @guest
                    <a href="{{ route('login') }}"
                       class="text-white px-4 ml-4 py-2 border border-white rounded hover:bg-white hover:text-indigo-800 block">Se
                        connecter</a>
                @else
                    <toggle-component class="relative">
                        <div slot="trigger" slot-scope="{ toggle }">
                            <a @click.prevent="toggle"
                               class="flex cursor-pointer items-center text-white px-4 md:ml-4 my-2 md:my-0 py-2 border border-white rounded hover:bg-white hover:text-indigo-800 block">
                                <svg class="fill-current mr-2" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui"
                                          d="M12 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v2z"/>
                                </svg>
                                {{ Auth::user()->name }}</a>
                        </div>
                        <div slot="toggleable" slot-scope="{ isOpen, close }">
                            <div class="fixed inset-0 bg-transparent z-50" v-show="isOpen" @click="close"></div>
                            <div class="absolute bg-white py-3 rounded shadow-lg z-50 xl:-ml-5 mt-2"
                                 v-show="isOpen">
                                <a href="{{ route('home') }}"
                                   class="block px-6 py-1 hover:text-white hover:bg-indigo-600">Annonces</a>
                                <a href="{{ route('categories') }}"
                                   class="block px-6 py-1 hover:text-white hover:bg-indigo-600">Catégories</a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="px-6 py-1 hover:text-white hover:bg-indigo-600">Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </toggle-component>
                @endif

            </nav>
            <div class="xl:hidden bg-gray-900 sm:px-24 px-6">
                @include('partials._search')
            </div>
        </header>
        <div class="h-5/6 flex relative"
             style="background-image: url('./assets/intro-background.jpg'); background-position: 50%, 20%; background-size: cover; background-repeat: no-repeat;">
            <div class="absolute w-full h-full flex justify-center items-center text-center"
                 style="background-color: rgba(0, 0, 0, 0.4);">
                <h3 class="relative text-white text-6xl font-bold">Bienvenu à Provital !</h3>
            </div>
        </div>
        @yield('main')
    </div>
@stop
