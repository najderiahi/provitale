
<div class="rounded-lg bg-white overflow-hidden shadow-lg">
    <img class="h-48 w-full object-cover" src="{{ $post->url }}" alt="">
    <div class="m-3">
        <span class="inline-block px-3 py-2 text-xs font-bold tracking-wide rounded-lg uppercase bg-orange-300 text-orange-900">{{ $post->category->name }}</span>
    </div>
    <div class="pb-6 px-3 pt-2" >
        <h3 class="block text-gray-600 font-bold overflow-hidden h-20 leading-relaxed" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ $post->description }}</h3>
    </div>


</div>
