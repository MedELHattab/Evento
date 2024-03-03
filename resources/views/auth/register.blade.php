<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Evento</title>
</head>
<body>
    <x-guest-layout>
        <link rel="stylesheet" href="path/to/font-awesome/css/all.min.css">
        <div class="bg-white ">
            <h2 class="flex justify-center text-2xl font-semibold mb-6">Register with</h2>
            <div class="flex justify-center gap-4">
                <!-- Google Registration Button -->
                <a href="/auth/google/redirect" class="bg-blue-600 text-white hover:bg-blue-700 py-2 px-4 rounded flex items-center justify-center mb-4">
                    <i class="fab fa-google" aria-hidden="true"></i>                  
                    Google
                </a>

                <!-- Facebook Registration Button -->
                <button class="bg-blue-700 text-white hover:bg-blue-800 py-2 px-4 rounded flex items-center justify-center mb-4">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i> Facebook
                </button>
            </div>
            <h2 class="flex justify-center text-2xl font-semibold mb-6">Or</h2>
        </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
</body>


