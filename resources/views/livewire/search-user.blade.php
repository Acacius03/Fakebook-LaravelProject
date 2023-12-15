<div>
    <form wire:submit="searchUser">
        <div
            class="search-box my-2 flex w-full max-w-[48px] rounded-full border border-gray-300 bg-gray-50 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white md:max-w-full">
            <label for="search" class="m-[14px] flex items-center text-xl text-gray-600">
                <i class="fa-solid fa-magnifying-glass"></i>
            </label>
            <input wire:model="search" id="search" name="search" type="search" placeholder="Search"
                class="w-full bg-transparent pe-4 text-lg outline-none dark:placeholder-gray-400">
        </div>
    </form>
</div>
