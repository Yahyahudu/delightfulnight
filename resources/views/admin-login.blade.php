<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Tea Party Cruise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                },
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap');

        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .premium-shadow {
            box-shadow: 0 25px 60px -15px rgba(180, 40, 100, 0.35), 0 8px 20px -8px rgba(0, 0, 0, 0.3);
        }
        .tap-target {
            min-height: 48px;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        input {
            font-size: 16px !important;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-delay-1 {
            animation-delay: 0.12s;
        }
        .animate-delay-2 {
            animation-delay: 0.24s;
        }
    </style>
</head>
<body class="bg-[#0d0418] text-white font-sans antialiased min-h-screen flex items-center justify-center overflow-x-hidden px-4 py-8" x-data="{ showPassword: false, loading: false }">
    <!-- Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-[#1a0a2e] via-[#2d1b4e] to-[#4a1942] -z-10"></div>
    <div class="fixed inset-0 bg-gradient-to-t from-[#0d0418]/70 via-transparent to-transparent -z-10"></div>
    <!-- Floating orbs -->
    <div class="fixed top-16 left-8 w-32 h-32 rounded-full bg-rose-400/8 blur-3xl -z-5"></div>
    <div class="fixed bottom-20 right-10 w-40 h-40 rounded-full bg-fuchsia-500/6 blur-3xl -z-5"></div>

    <!-- Login Card -->
    <div class="w-full max-w-md glass-card rounded-3xl p-6 sm:p-8 md:p-10 premium-shadow animate-fade-in-up">
        <!-- Logo -->
        <div class="text-center mb-8 animate-fade-in-up animate-delay-1">
            <span class="text-4xl mb-3 block">🫖</span>
            <h1 class="font-display text-2xl sm:text-3xl font-bold">Admin Login</h1>
            <p class="text-white/40 text-sm mt-2">Tea Party Cruise Management</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5 animate-fade-in-up animate-delay-2" @submit="loading = true">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-white/70 mb-1.5">Email Address</label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-white/5 border border-white/15 rounded-xl pl-12 pr-4 py-3.5 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all" placeholder="admin@teapartycruise.com">
                </div>
                @error('email')
                    <p class="text-rose-300 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-white/70 mb-1.5">Password</label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <input :type="showPassword ? 'text' : 'password'" name="password" required class="w-full bg-white/5 border border-white/15 rounded-xl pl-12 pr-12 py-3.5 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all" placeholder="••••••••">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 tap-target w-10 h-10 text-white/40 hover:text-white transition-colors" aria-label="Toggle password visibility">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="remember" value="1" class="w-4 h-4 rounded border-white/20 bg-white/5 text-fuchsia-500 focus:ring-fuchsia-500 focus:ring-offset-0 cursor-pointer">
                    <span class="text-white/60">Remember me</span>
                </label>
                <a href="#" class="text-rose-400 hover:text-rose-300 transition-colors font-medium">Forgot password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" :disabled="loading" class="tap-target w-full py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold text-lg premium-shadow hover:shadow-xl hover:shadow-rose-500/40 transition-all duration-300 disabled:opacity-60 flex items-center justify-center gap-2">
                <span x-show="!loading">Sign In</span>
                <span x-show="loading" class="flex items-center gap-2" style="display:none;">
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                    Signing in...
                </span>
            </button>
        </form>

        <!-- Footer link -->
        <p class="text-center text-white/30 text-xs mt-8">
            <a href="{{ route('landing') }}" class="hover:text-rose-300 transition-colors">← Back to Event Page</a>
        </p>
    </div>
</body>
</html>