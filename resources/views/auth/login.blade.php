@extends('layouts.app')

@section('title', config('app.name').' | Connexion')
@section('content')

<div class="z-20 absolute text-white mt-6 ml-6 font-bold">
    <a class="font-bold text-sm hover:underline uppercase tracking-wide" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-white w-6 h-6" viewBox="0 0 20 20"><path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/></svg>
    </a>
</div>
<div class="p-6 bg-indigo-800 min-h-screen flex flex-col justify-center items-center relative z-10">
    <h2 class="text-4xl font-bold text-white">Provitale<span class="text-5xl text-indigo-300">.</span></h2>
    <div class="w-full max-w-sm">
        <form class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="px-6 sm:px-10 sm:pt-10 pt-6">
                <h3 class="font-bold text-indigo-800 text-xl">Connectez-vous à votre compte</h3>
            </div>
            <div class="px-6 sm:px-10 pt-2">
                <label class="mt-6 select-none flex items-center text-gray-800 mb-2" for="email">Adresse électronique</label>
                <input id="email" type="email" name="email" class="w-full form-input bg-gray-100 @error('password') border-red-700 bg-red-100 @enderror">
                @error('email')
                    <span class="text-sm text-red-700">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 sm:px-10 pt-2 ">
                <label class="mt-6 select-none flex items-center text-gray-800 mb-2" for="passwor">Mot de passe</label>
                <input id="password" type="password" name="password" class="w-full form-input bg-gray-100 @error('password') border-red-700 bg-red-100 @enderror">
                @error('password')
                    <span class="text-sm text-red-700">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-6 sm:px-10">
                <label class="mt-6 select-none flex items-center" for="remember">
                    <input id="remember" class="mr-1 form-checkbox text-indigo-700" type="checkbox">
                    <span class="text-sm text-gray-800">Se souvenir de moi</span>
                </label>
            </div>
            <div class="px-6 sm:px-10">
                <button type="submit" class="block text-center bg-indigo-800 text-white w-full py-2 rounded my-4 focus:overline-none focus:shadow-outline">Se connecter</button>
            </div>
            <div class="px-10 py-4 bg-grey-lightest border-t border-grey-lighter flex justify-between items-center">
                <a class="hover:underline text-indigo-800 text-sm" tabindex="-1">Mot de passe oublié?</a>
            </div>
        </form>
    </div>
</div>
@stop
