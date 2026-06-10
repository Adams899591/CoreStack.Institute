<div class="flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1522204523234-8729aa607dc7?q=80&w=1600&auto=format&fit=crop');">
    <div>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm text-center">
        <div class="mb-6">
            {{-- Placeholder for your logo --}}
            <img src="{{ asset('image/core-stack.png') }}" alt="CoreStack Institute Logo" class="mx-auto w-24 h-24 object-cover rounded-full border-4 border-[#D4AF37] p-1">
        </div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                    Teacher Login
        </h2>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        {{-- Livewire Form --}}
        <form wire:submit.prevent="login" class="space-y-4">
            {{-- Email Input --}}
            <div class="text-left">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </span>
                    <input
                        type="email"
                        id="email"
                        wire:model.defer="email"
                        class="shadow appearance-none border rounded-md w-full py-2 pl-10 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Input --}}
            <div class="text-left">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-key text-gray-400"></i>
                    </span>
                    <input
                        type="password"
                        id="password"
                        wire:model.defer="password"
                        class="shadow appearance-none border rounded-md w-full py-2 pl-10 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                        required
                    >
                </div>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.defer="remember" class="form-checkbox h-4 w-4 text-[#1A2B4C] transition duration-150 ease-in-out">
                    <span class="ml-2 text-gray-700">Remember Me</span>
                </label>
                <a href="#" class="font-semibold text-[#1A2B4C] hover:text-[#D4AF37]">Forgot Password?</a>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit" class="bg-[#1A2B4C] text-white py-2 px-3 rounded-md cursor-pointer text-sm w-full hover:bg-[#D4AF37] focus:outline-none focus:shadow-outline transition duration-150 ease-in-out" wire:loading.attr="disabled" wire:target="login">
                    <span wire:loading.remove wire:target="login">Sign in</span>
                    <span wire:loading wire:target="login">Signing in...</span>
                </button>
            </div>
        </form>
    </div>
