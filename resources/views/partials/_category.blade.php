<div class="pt-4">
    <div class="flex items-baseline justify-between border-b py-2">
        <span class="text-gray-700 font-bold uppercase tracking-wide text-sm border-b border-indigo-500 -mb-2 pb-2">{{ $category->name }}</span>
    </div>
    <section class="my-6">
        <div class="flex flex-wrap -mx-3">
            @foreach($category->posts as $post)
                <div class="w-full md:w-1/3 sm:w-1/2 px-3 mt-4">
                    @include('partials._post', ['post' => $post])
                </div>
            @endforeach
        </div>
    </section>
</div>
