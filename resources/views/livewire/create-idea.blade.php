<form wire:submit.prevent="createIdea" action="#" method="POST" class="space-y-4 px-4 pt-4 pb-6">
    <div>
        <p class="px-4 pb-2">Enter title:</p>
        <input wire:model.defer="title" type="text" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your Idea" required>
        @error('title')
            <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <p class="px-4 pb-2">Select a category:</p>
        <select wire:model.defer="category" name="category_add" id="category_add" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
            <option value="" hidden>Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <p class="px-4 pb-2">Enter amount:</p>
        <input wire:model.defer="amount" type="number" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Total amount" required>
        @error('amount')
            <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
        @enderror
        <p class="text-info text-xs pt-2 px-2 text-justify">When creating an idea, {{ config('ideas.percent') }}% of the entered amount will be charged from your balance</p>
    </div>
    <div>
        <p class="px-4 pb-2">Write a description:</p>
        <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Describe your idea" required></textarea>
        @error('description')
            <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
        @enderror
    </div>
    <div
        x-data="{ isUploading: false }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
    >
        <input id="files" class="hidden" type="file" wire:model="files" multiple>
        <div wire:loading wire:target="files" class="text-center w-full mb-2">Attaching files...</div>
        <div class="flex items-center justify-between space-x-3">
            <label
                for="files"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
            >
                <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <span class="ml-1">Attach</span>
            </label>
            <button
                x-show="!isUploading"
                type="submit"
                class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
            >
                <span class="ml-1">Submit</span>
            </button>
            <button
                x-show="isUploading"
                disabled
                type="submit"
                class="pointer-events-none opacity-50 flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
            >
                <span class="ml-1">Submit</span>
            </button>
        </div>
    </div>
    @error('files')
        <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
    @enderror
    @error('files.*')
        <p class="text-red text-xs mt-1 px-2">{{ $message }}</p>
    @enderror
</form>