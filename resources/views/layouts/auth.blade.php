@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 h-screen">
        <header class="h-64 bg-indigo-800 relative -mb-32">
            <nav class=" px-6 sm:px-24 pt-6 pb-4 flex items-center justify-between" style="border-bottom: 1px solid rgba(255, 255, 255, .1)">
                <div class="flex items-center">
                    <a href="/" class="block pr-2"><h2 class="text-2xl font-bold text-white">Provitale<span
                                class="text-3xl text-indigo-300">.</span></h2></a>
                    <ul class="flex items-baseline ml-6">
                        @auth
                            <li class="text-white py-2 mx-2 rounded px-4" @if(Request::is('home')) style="background-color: rgba(0, 0, 0, .2)" @endif ><a href="{{ route('home') }}" >Annonces</a></li>
                            <li class="text-white py-2 mx-2 px-4 rounded" @if(Request::is('categories')) style="background-color: rgba(0, 0, 0, .2)" @endif ><a href="{{ route('categories') }}">Catégories</a></li>
                        @endauth
                    </ul>
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
                                <form action="{{ route('logout') }}" method="post" class="z-20 relative">
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
