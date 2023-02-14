<x-guest-layout>
    {{ $errors }}
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        <input type="hidden" class="g-recaptcha" name="recaptcha_token" id="recaptcha_token">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4" typwe="button" onclick="onClick(event)">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    @push('scripts')
        <script>
            function onClick(e) {
                e.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'register'}).then(function(token) {
                        document.getElementById("recaptcha_token").value = token;
                        document.getElementById('registerForm').submit();
                    });
                });
            }
        </script>
{{--        <script>--}}
{{--            function onSubmit(token) {--}}
{{--                document.getElementById("registerForm").submit();--}}
{{--            }--}}
{{--        </script>--}}
        <script>
            grecaptcha.ready(function () {
                document.getElementById('registerForm').addEventListener("submit", function (event) {
                    event.preventDefault();
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'register' })
                        .then(function (token) {
                            document.getElementById("recaptcha_token").value = token;
                             document.getElementById('registerForm').submit();
                        });
                });
            });
        </script>
    @endpush
</x-guest-layout>
