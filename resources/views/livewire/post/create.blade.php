<div x-data="{ 'show': false }">
    <div class="flex gap-2 rounded-md bg-white p-4 dark:bg-gray-800">
        <div class="h-14 w-14 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
            <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
        </div>
        <button x-on:click="show=!show"
            class="flex-grow rounded-full border border-gray-300 bg-gray-50 px-6 text-start text-2xl font-bold text-gray-400 outline-none hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-neutral-600">
            What's on your mind? {{ auth()->user()->name }}
        </button>
    </div>
    <div x-show="show" x-cloak @click.outside="show = false" @close.stop="show = false"
        class="container absolute left-[50%] top-[40%] flex max-h-[45rem] max-w-[31.25rem] translate-x-[-50%] translate-y-[-50%] flex-col overflow-hidden rounded-xl bg-white">
        <header class="relative border-b border-neutral-200 p-5">
            <h3 class="text-center text-xl font-bold">Create Post</h3>
            <button x-on:click="show=false"
                class="flex-center-center absolute right-5 top-[50%] h-10 w-10 translate-y-[-50%] overflow-hidden rounded-full bg-neutral-200 text-2xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </header>
        <div class="flex flex-col gap-1 p-6">
            <div class="flex h-12 items-center gap-3">
                <div class="h-14 w-14 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
                    <x-avatar :image="auth()->user()->profile_photo"></x-avatar>
                </div>
                <div class="leading-none">
                    <span class="font-bold">{{ auth()->user()->name }}</span> <br>
                    <small> {{ now('Asia/Manila')->format('F j, Y, h:ia') }} </small>
                </div>
            </div>
            <form x-data="{ 'preview': '' }" wire:submit="createPost" enctype="multipart/form-data"
                class="mt-2 flex flex-grow flex-col gap-2 px-2" enctype="multipart/form-data">
                <x-input-error class="mt-2" :messages="$errors->get('body')" />
                <div class="max-h-[12.5rem]">
                    <textarea wire:model="body" id="content" name="content"
                        class="h-auto max-h-40 w-full resize-none overflow-auto bg-transparent text-2xl outline-none"
                        placeholder="Whats's on your mind?" x-ref="textarea"
                        @input="$refs.textarea.style.height = 'auto'; $refs.textarea.style.height = $refs.textarea.scrollHeight + 'px'"></textarea>
                </div>
                <div x-show="preview!==''" class="relative mb-2 rounded-md border border-neutral-400 p-2">
                    <div @click="preview='';"
                        class="flex-center-center absolute right-3 top-3 z-50 rounded-full border bg-neutral-100 px-[.4063rem] py-[.25rem] text-xl text-neutral-400 shadow-lg">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <figure class="h-60 w-full">
                        <img class="aspect-auto h-full object-contain" src="https://picsum.photos/300/200"
                            x-bind:src="preview" alt="Preview Image">
                    </figure>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                <div
                    class="mt-auto flex items-center justify-between rounded-md border border-neutral-400 p-4 dark:border">
                    <input wire:model="image" id="photo" class="hidden" name="photo"
                        accept="image/jpeg, image/png" type="file"
                        @change="preview=URL.createObjectURL($event.target.files[0])">
                    <p class="text-base font-bold">Add to your post</p>
                    <div class="flex items-center text-3xl">
                        <label :class="preview ? ' bg-neutral-600/20' : ''"
                            class="w-11 rounded-full py-1 text-center text-green-500 hover:bg-slate-600/20"
                            for="photo">
                            <i class="fa-solid fa-image"></i></label>
                    </div>
                </div>
                <button @click="
                    preview='';
                    show=false;
                "
                    class="w-full rounded-lg bg-blue-700 p-2 text-xl font-bold text-white">Post</button>
            </form>
        </div>
    </div>
</div>
