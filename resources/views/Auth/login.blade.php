@extends('app')
@section('content')

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0  dark:bg-gray-900">
        <a href="/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
            <img src="/images/logo.svg" class="mr-4 h-11" alt="FlowBite Logo">
            <span> Simerak App</span>
        </a>
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Welcome Back!
            </h2>
            <form class="mt-8 space-y-6" action="#">
                <div>
                    <x-text-input for="username" id="username" type="text" name="username" placeholder="username" label="Username" />
                </div>
                <div>
                    <x-text-input for="password" id="password" type="password" name="password" placeholder="••••••••" label="Your password" />
                </div>
                <x-button label="Login" type="submit">Login</x-button>
            </form>
        </div>
    </div>
  </section>

@endsection

