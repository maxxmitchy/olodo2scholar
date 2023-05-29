<div x-show="!slides[start_slide].image">
    <div
        class="flex tracking-wider prose-sm prose prose:drop-shadow-md prose-headings:font-bold lg:prose-base prose-slate prose-blockquote:font-semibold prose-a:font-bold prose-a:text-white prose-a:underline">
        <div class="flex flex-col h-full p-4 my-8 text-white">
            <div class="">
                <div x-show="slides[start_slide].title" x-cloak
                    class="p-2 px-4 text-xl uppercase bg-white rounded drop-shadow text-slate-500"
                    x-text="slides[start_slide].title"></div>
            </div>
            <div class="justify-center text-lg font-bold " x-html="slides[start_slide].body"></div>
        </div>
    </div>
</div>
