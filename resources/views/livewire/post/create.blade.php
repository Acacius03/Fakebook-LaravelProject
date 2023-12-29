<div x-data="{ 'show': false }"
    class="flex gap-2 rounded-lg border bg-white p-4 shadow-md dark:border-0 dark:bg-gray-700 dark:text-white">
    <a href="/user/{{ auth()->user()->id }}" wire:navigate class="h-10 w-10 rounded-full">
        <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
    </a>
    <button x-on:click="show=!show"
        class="flex-grow rounded-full border border-gray-400 bg-gray-200 px-6 text-start text-xl text-gray-700 outline-none hover:bg-gray-400 dark:border-gray-950 dark:hover:bg-gray-950">
        What's on your mind, {{ explode(' ', auth()->user()->name)[0] }}?
    </button>
    <div x-show="show" x-cloak @click.outside="show=false" @close.stop="show=false"
        class="fixed-center container z-[100] flex max-h-[720px] max-w-[720px] flex-col overflow-hidden rounded-xl border bg-white shadow-xl">
        <header class="relative border-b border-neutral-200 p-5">
            <h3 class="text-center text-2xl font-bold">Create Post</h3>
            <button x-on:click="show=false"
                class="absolute-center-y flex-center-center right-5 h-10 w-10 rounded-full bg-gray-200 text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>
        <div class="flex flex-col gap-1 overflow-y-auto p-6">
            <div class="flex h-12 items-center gap-3">
                <figure class="h-14 w-14 rounded-full">
                    <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
                </figure>
                <div class="leading-none">
                    <span class="font-bold">{{ auth()->user()->name }}</span><br>
                    <small>{{ now('Asia/Manila')->format('F j, Y, h:ia') }}</small>
                </div>
            </div>
            <form x-data="{ 'preview': '' }" wire:submit="createPost" enctype="multipart/form-data"
                class="mt-2 flex flex-grow flex-col gap-2 px-2" enctype="multipart/form-data">
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
                <div class="max-h-[200px]">
                    <textarea wire:model="body" id="content" name="content" placeholder="Whats's on your mind?" x-ref="textarea"
                        @input="$refs.textarea.style.height = 'auto';
                        $refs.textarea.style.height = $refs.textarea.scrollHeight + 'px'"
                        class="max-h-40 w-full resize-none bg-transparent p-2 text-2xl outline-none"></textarea>
                </div>
                <div x-show="preview!==''" class="relative mb-2 rounded-md border border-neutral-400 p-2">
                    <div @click="preview='';"
                        class="flex-center-center absolute right-3 top-3 z-50 rounded-full border bg-neutral-100 px-[6.5008px] py-[4px] text-xl text-neutral-400 shadow-lg">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <figure class="max-h-[680px] w-full">
                        <img class="mx-auto min-h-[200px] object-contain" x-bind:src="preview"
                            alt="Preview Image">
                    </figure>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                <div class="flex items-center justify-between rounded border border-neutral-400 p-4">
                    <input wire:model="image" id="image" class="hidden" name="image"
                        accept="image/jpeg, image/png" type="file"
                        @change="preview=URL.createObjectURL($event.target.files[0])">
                    <p class="font-bold">Add to your post</p>
                    <div class="flex items-center gap-1 text-3xl">
                        <label :class="preview ? 'bg-neutral-600/20' : ''"
                            class="w-11 rounded-full p-1 text-center text-red-600 hover:bg-slate-600/20" for="photo">
                            <i class="fa-solid fa-video"></i>
                        </label>
                        <label :class="preview ? 'bg-neutral-600/20' : ''"
                            class="w-11 rounded-full p-1 text-center text-green-500 hover:bg-slate-600/20"
                            for="image">
                            <i class="fa-solid fa-image"></i>
                        </label>
                    </div>
                </div>
                <button @click="preview='';show=false;"
                    class="w-full rounded bg-blue-700 py-2 text-xl font-bold text-white">
                    Post
                </button>
            </form>
        </div>
    </div>
</div>
