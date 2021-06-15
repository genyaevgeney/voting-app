<div
    x-data
    @click="
        const clicked = $event.target
        const target = clicked.tagName.toLowerCase()
        const ignores = ['button', 'svg', 'path', 'a']
        if (! ignores.includes(target)) {
            clicked.closest('.idea-container').querySelector('.idea-link').click()
        }
    "
    class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
>
    <div class="p-5 flex-grow">
        <div class="flex flex-col md:flex-row flex-1 mb-2">
            <div class="flex-none mx-2 md:mx-0">
                <img src="https://cdn.pixabay.com/photo/2015/11/19/06/32/book-1050428_960_720.jpg" alt="photo" class="w-14 h-14 rounded-xl">
            </div>
            <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                <div class="flex mb-3">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0 flex-grow pr-4">
                        <a href="{{ route('idea.show', $idea) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
                    </h4>
                    <button
                        x-data="{ isOpen: false }"
                        @click="isOpen = !isOpen"
                        class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-5"
                    >
                        <svg fill="currentColor" width="24" height="6">
                            <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                        </svg>
                        <ul
                            x-cloak
                            x-show.transition.origin.top.left="isOpen"
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                        >
                            <li>
                                <span class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                    Delete Post
                                </span>
                            </li>
                        </ul>
                    </button>
                </div>
                <p class="text-gray-600 line-clamp-2">
                    {{ $idea->description }}
                </p>
            </div>
        </div>
        <div>
            <div class="flex items-center mb-3">
                <div class="category-icon">
                    <div class="category-icon-part"></div>
                </div>
                <span class="text-gray-400 font-semibold">{{ $idea->category->name }}</span>
            </div>
            <div class="flex justify-between items-end">
                <div class="flex flex-col w-3/5">
                    <span class="text-gray-600 mb-2">$150.00 raised of $300.00 Goal</span>
                    <progress class="progress-bar" max="100" value="12"></progress>
                </div>
                <span class="text-gray-600">30 days ago</span>
            </div>
        </div>
    </div>
    <div class="hidden md:flex border-l border-gray-100 px-5 py-8 flex-col justify-between">
        <div class="text-center mb-8">
            <p class="text-gray-500 mb-1">$ 0.00</p>
            <p class="text-gray-500">Donated</p>
        </div>

        <div>
            @if ($hasDonated)
                <button wire:click.prevent="donate" class="w-20 bg-blue text-white border border-blue hover:bg-blue-hover font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-2">Donated</button>
            @else
                <button wire:click.prevent="donate" class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-2">Donate</button>
            @endif
        </div>
    </div>
</div>