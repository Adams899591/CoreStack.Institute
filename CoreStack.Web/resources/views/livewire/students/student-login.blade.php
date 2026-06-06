<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Animated Technical Globe Background -->
    <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-40">
        <div class="relative w-[600px] h-[600px] sm:w-[900px] sm:h-[900px] lg:w-[1200px] lg:h-[1200px]">
            <!-- Global Atmosphere Glow -->
            <div class="absolute inset-0 rounded-full bg-darkblue/40 blur-[120px] animate-pulse-slow"></div>
            
            <!-- Rotating Sphere -->
            <div class="absolute inset-0 rounded-full border border-gold/10 overflow-hidden shadow-[inset_0_0_100px_rgba(0,31,63,0.8)] bg-[#001220]/50 backdrop-blur-sm">
                <!-- Dotted Map Layer (Technical Blueprint Feel) -->
                <div class="absolute inset-0 opacity-30 animate-globe-rotate mix-blend-screen" 
                     style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22200%22 viewBox=%220 0 400 200%22%3E%3Ccircle cx=%2220%22 cy=%2250%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%2260%22 cy=%2280%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22120%22 cy=%2240%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22180%22 cy=%22110%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22250%22 cy=%2260%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22320%22 cy=%22130%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22380%22 cy=%2230%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%2250%22 cy=%22150%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22150%22 cy=%22170%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3Ccircle cx=%22280%22 cy=%22160%22 r=%221.5%22 fill=%22%23D4AF37%22/%3E%3C/svg%3E'); background-repeat: repeat-x; background-size: 50% 100%;"></div>
                
                <!-- Lighting & Shadow Overlays -->
                <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-transparent to-white/5"></div>
                <div class="absolute inset-0 shadow-[inset_-60px_-60px_120px_rgba(0,0,0,1)]"></div>
            </div>
            
            <!-- Orbiting Geometric Elements -->
            <div class="absolute inset-0 border border-gold/10 rounded-full scale-110 rotate-[25deg]"></div>
            <div class="absolute inset-0 border border-darkblue/30 rounded-full scale-[1.3] -rotate-[35deg]"></div>
        </div>
    </div>

    <div class="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        <!-- Logo/Brand Section -->
        <div class="flex flex-col items-center">
            <div class="w-20 h-20 bg-darkblue rounded-2xl flex items-center justify-center shadow-2xl mb-4 border border-gold/30 backdrop-blur-md">
                <span class="text-white font-black text-3xl tracking-tighter uppercase">CS</span>
            </div>
            <h2 class="text-center text-3xl font-extrabold text-white tracking-tight drop-shadow-lg">
                Student Portal
            </h2>
            <p class="mt-2 text-center text-sm text-stone-300">
                Sign in to <span class="font-bold text-gold">CoreStack Institute</span>
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md relative z-10 px-4 sm:px-0">
        <div class="bg-white/95 backdrop-blur-xl py-8 px-4 shadow-2xl shadow-black/40 sm:rounded-2xl sm:px-10 border border-white/20">
            <form wire:submit.prevent="login" class="space-y-6">
                <!-- Matric Number Field -->
                <div>
                    <label for="matric_number" class="block text-xs font-bold uppercase tracking-widest text-stone-600 mb-1">
                        Matric Number
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </div>
                        <input wire:model="matric_number" id="matric_number" name="matric_number" type="text" required 
                            placeholder="e.g. CSE/2024/001"
                            class="block w-full pl-10 pr-3 py-3 border border-stone-300 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold sm:text-sm transition duration-150 ease-in-out">
                    </div>
                    @error('matric_number') <span class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-1">
                        Password
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-stone-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input wire:model="password" id="password" name="password" type="password" required 
                            placeholder="••••••••"
                            class="block w-full pl-10 pr-3 py-3 border border-stone-300 rounded-xl leading-5 bg-stone-50 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold sm:text-sm transition duration-150 ease-in-out">
                    </div>
                    @error('password') <span class="text-red-600 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" 
                            class="h-4 w-4 text-darkblue focus:ring-gold border-stone-300 rounded">
                        <label for="remember_me" class="ml-2 block text-xs text-stone-600 font-medium">
                            Remember me
                        </label>
                    </div>

                    <div class="text-xs">
                        <a href="#" class="font-bold text-gold hover:text-gold-dark transition">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-darkblue hover:bg-darkblue-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-darkblue transition duration-150 ease-in-out">
                        <span wire:loading.remove wire:target="login">Sign in to Portal</span>
                        <span wire:loading wire:target="login" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            Authenticating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
