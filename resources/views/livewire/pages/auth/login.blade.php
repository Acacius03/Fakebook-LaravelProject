<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
    }
}; ?>

<div>
    <div class="h-screen grid-cols-2 lg:grid">
        <div class="hidden bg-cover bg-center lg:block" style="background-image: url('/image/login_bg.jpg')">
        </div>
        <div class="flex h-full flex-col justify-end gap-20">
            <div>
                <h2
                    class="mx-auto mb-5 h-20 w-20 overflow-hidden rounded-lg bg-blue-700 pr-4 text-right text-8xl font-bold text-white">
                    f</h2>
                <h2 class="text-center text-3xl font-bold">Sign in to your account</h2>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="my-2 pr-10 text-right" :status="session('status')" />
            <div class="mx-auto w-4/5 rounded-md border bg-white p-10 shadow-lg">
                <form wire:submit="login">
                    <!-- Email Address -->
                    <div>
                        <div class="flex items-center justify-between">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full border p-2"
                            type="email" name="email" required autofocus autocomplete="username" />
                    </div>
                    <!-- Password -->
                    <div class="my-2">
                        <div class="flex items-center justify-between">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <x-text-input wire:model="form.password" id="password" class="mt-1 block w-full border p-2"
                            type="password" name="password" required autocomplete="current-password" />
                    </div>
                    <!-- Remember Me -->
                    <div class="mt-4 block">
                        <label for="remember" class="inline-flex items-center">
                            <input wire:model="formNaNpxember" id="remember" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <a class="m-1 ml-auto block w-max px-1 text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                    <input class="w-full rounded-md bg-blue-700 py-2 text-xl font-bold text-white" type="submit"
                        value="{{ __('Log in') }}">
                </form>
                <p
                    class="my-4 flex items-center justify-center gap-2 px-5 before:h-[1px] before:flex-auto before:bg-black after:h-[1px] after:flex-auto after:bg-black">
                    Or</p>
                <a class="mx-auto block w-max text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100"
                    href="{{ route('register') }}">
                    Create a new account
                </a>
            </div>
            <footer class="border-t-2 bg-white py-10 text-center">
                <p>Fakebook Copyright &copy; 2023, All Rights Reserved.</p>
            </footer>
        </div>
    </div>
</div>
