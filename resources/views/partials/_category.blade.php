<div class="pt-4">
    <div class="flex items-baseline justify-between">
        <span class="text-gray-700 font-bold text-3xl mb-2 pb-2">{{ $category->name }}</span>
    </div>
    <section class="my-6">
        <div class="flex flex-wrap -mx-4">
            @forelse($category->posts as $post)
                <div class="w-full md:w-1/3 sm:w-1/2 px-3 mt-4">
                    <post-component image="{{ $post->url }}" description="{{ $post->description }}"></post-component>
                </div>
            @empty
                <div class="px-3 font-bold text-gray-600">Pas de posts dans cette catégorie</div>
            @endforelse
        </div>
    </section>
</div>
