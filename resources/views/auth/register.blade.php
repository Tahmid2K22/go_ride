<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-slate-900">{{ __('app.register_title') }}</h2>
        <p class="mt-2 text-sm text-slate-500">{{ __('app.register_subtitle') }}</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 rounded-xl border border-red-100">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <div>
                    @foreach ($errors->all() as $error)
                        <p class="text-sm text-red-600">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('app.full_name') }}</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                   class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3"
                   placeholder="{{ __('app.name_placeholder') }}">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('app.email') }}</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                   class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3"
                   placeholder="{{ __('app.email_placeholder') }}">
        </div>

        <!-- Phone Number -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('app.phone') }}</label>
            <div class="flex">
                <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm font-medium">
                    +880
                </span>
                <input id="phone" type="tel" name="phone" :value="old('phone')" required autocomplete="tel"
                       class="block w-full rounded-r-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3"
                       placeholder="{{ __('app.phone_placeholder') }}"
                       pattern="[0-9]{10}" maxlength="10">
            </div>
            <p class="mt-1.5 text-xs text-slate-400">{{ __('app.phone_hint') }}</p>
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('app.password') }}</label>
            <div class="relative">
                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                       class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3 pr-12"
                       placeholder="{{ __('app.password_placeholder') }}">
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition">
                    <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('app.confirm_password') }}</label>
            <div class="relative">
                <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full rounded-xl border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 text-sm px-4 py-3 pr-12"
                       placeholder="{{ __('app.confirm_password_placeholder') }}">
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition">
                    <svg x-show="!show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg x-show="show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-sm rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150">
            {{ __('app.create_account') }}
        </button>
    </form>

    <!-- Switch to Login -->
    <div class="mt-8 text-center">
        <p class="text-sm text-slate-500">
            {{ __('app.has_account') }}
            <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700 transition">
                {{ __('app.sign_in_link') }}
            </a>
        </p>
    </div>
</x-guest-layout>
