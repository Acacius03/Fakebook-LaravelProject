<button x-data="{
    darkMode: localStorage.getItem('color-theme') !== 'light',
    toggle: function() {
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
                this.darkMode = true;
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
                this.darkMode = false;
            }
        }
    }
}" @click="toggle"
    class="flex justify-between p-4 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-gray-300 dark:hover:bg-gray-800 dark:focus:bg-gray-800">
    Dark Mode
    <i x-show="!darkMode" class='fa-solid fa-sun'></i>
    <i x-show="darkMode" class='fa-solid fa-moon'></i>
</button>
