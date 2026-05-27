<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Party Cruise — Delightful Night</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    colors: {
                        fuchsia: {
                            400: '#e879f9',
                            500: '#d946ef',
                            600: '#c026d3',
                            700: '#a21caf',
                            800: '#86198f',
                        },
                        rose: {
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                        },
                        gold: {
                            300: '#fde68a',
                            400: '#fcd34d',
                            500: '#fbbf24',
                            600: '#f59e0b',
                        },
                    },
                },
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap');

        :root {
            --fuchsia-glow: 267 100% 60%;
            --gold-warm: 43 96% 56%;
            --rose-soft: 350 89% 60%;
        }

        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        .hero-gradient {
            background: linear-gradient(160deg,
                    #1a0a2e 0%,
                    #2d1b4e 15%,
                    #4a1942 30%,
                    #6b2245 45%,
                    #8b3a4a 60%,
                    #a0524d 75%,
                    #b8694e 90%,
                    #c4805a 100%);
        }

        .hero-overlay {
            background: linear-gradient(180deg,
                    rgba(26, 10, 46, 0.3) 0%,
                    rgba(26, 10, 46, 0.0) 40%,
                    rgba(0, 0, 0, 0.4) 70%,
                    rgba(0, 0, 0, 0.7) 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-nav {
            background: rgba(26, 10, 46, 0.6);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-nav.scrolled {
            background: rgba(26, 10, 46, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .premium-shadow {
            box-shadow: 0 25px 60px -15px rgba(180, 40, 100, 0.35),
                0 8px 20px -8px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .gold-shimmer {
            background: linear-gradient(135deg,
                    #fbbf24 0%,
                    #fcd34d 20%,
                    #fef3c7 40%,
                    #fbbf24 60%,
                    #f59e0b 80%,
                    #fbbf24 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        .float-slow {
            animation: floatSlow 6s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
            opacity: 0;
        }

        .animate-delay-1 { animation-delay: 0.15s; }
        .animate-delay-2 { animation-delay: 0.3s; }
        .animate-delay-3 { animation-delay: 0.45s; }
        .animate-delay-4 { animation-delay: 0.6s; }

        .pulse-dot {
            animation: pulseDot 2s ease-in-out infinite;
        }
        @keyframes pulseDot {
            0%, 100% { box-shadow: 0 0 0 0 rgba(244, 114, 182, 0.6); }
            50% { box-shadow: 0 0 0 18px rgba(244, 114, 182, 0); }
        }

        .tap-target {
            min-height: 48px;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .smooth-scroll-container {
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
        }

        .gallery-card {
            transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                box-shadow 0.35s ease;
        }
        .gallery-card:active {
            transform: scale(0.96);
        }
        @media (hover: hover) {
            .gallery-card:hover {
                transform: translateY(-6px);
                box-shadow: 0 30px 50px -20px rgba(180, 40, 100, 0.5);
            }
        }
    </style>
</head>
<body class="bg-[#0d0418] text-white font-sans antialiased overflow-x-hidden" x-data="{ mobileMenuOpen: false, activeFaq: null, scrolled: false }" @scroll.window="scrolled = window.scrollY > 50">

    <!-- ==================== NAVIGATION ==================== -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-400"
        :class="scrolled ? 'glass-nav scrolled py-3' : 'bg-transparent py-4'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2.5 z-10">
                <span class="text-2xl">🫖</span>
                <span class="font-display text-xl sm:text-2xl font-bold tracking-tight text-white">
                    Tea<span class="text-rose-400">Party</span>Cruise
                </span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium tracking-wide">
                <a href="#highlights" class="text-white/80 hover:text-rose-300 transition-colors duration-200">Highlights</a>
                <a href="#gallery" class="text-white/80 hover:text-rose-300 transition-colors duration-200">Gallery</a>
                <a href="#contact" class="text-white/80 hover:text-rose-300 transition-colors duration-200">Contact</a>
                <a href="{{ route('register') }}" class="tap-target px-6 py-2.5 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold premium-shadow hover:shadow-lg hover:shadow-rose-500/30 transition-all duration-300 text-sm">
                    Reserve Your Spot
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden tap-target z-10 relative" aria-label="Toggle menu">
                <span class="sr-only">Menu</span>
                <div class="w-6 flex flex-col gap-1.5">
                    <span class="block h-0.5 w-6 bg-white rounded-full transition-all duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-2' : ''"></span>
                    <span class="block h-0.5 w-6 bg-white rounded-full transition-all duration-300" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                    <span class="block h-0.5 w-6 bg-white rounded-full transition-all duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
                </div>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden absolute top-full left-0 right-0 glass-nav border-t border-white/10 py-6 px-6" @click.outside="mobileMenuOpen = false" style="display: none;">
            <div class="flex flex-col gap-5 text-center">
                <a href="#highlights" @click="mobileMenuOpen = false" class="text-white/80 hover:text-rose-300 text-lg py-3 transition-colors">Highlights</a>
                <a href="#gallery" @click="mobileMenuOpen = false" class="text-white/80 hover:text-rose-300 text-lg py-3 transition-colors">Gallery</a>
                <a href="#contact" @click="mobileMenuOpen = false" class="text-white/80 hover:text-rose-300 text-lg py-3 transition-colors">Contact</a>
                <a href="{{ route('register') }}" class="tap-target mx-auto w-full max-w-xs py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold premium-shadow text-lg">
                    Reserve Your Spot
                </a>
            </div>
        </div>
    </nav>

    <!-- ==================== HERO SECTION ==================== -->
    <section class="relative min-h-screen flex items-end pb-16 sm:pb-20 md:pb-24 overflow-hidden hero-gradient">
        <!-- Atmospheric overlay -->
        <div class="absolute inset-0 hero-overlay z-0"></div>

        <!-- Decorative floating elements -->
        <div class="absolute top-20 left-6 sm:left-12 w-16 h-16 sm:w-24 sm:h-24 rounded-full bg-rose-400/15 blur-3xl float-slow z-0"></div>
        <div class="absolute top-40 right-8 sm:right-20 w-20 h-20 sm:w-32 sm:h-32 rounded-full bg-fuchsia-500/10 blur-3xl float-slow z-0" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-32 left-1/3 w-24 h-24 sm:w-40 sm:h-40 rounded-full bg-gold-400/8 blur-3xl float-slow z-0" style="animation-delay: 4s;"></div>

        <!-- Subtle sparkle dots -->
        <div class="absolute top-1/4 left-[15%] w-1 h-1 bg-gold-300 rounded-full pulse-dot z-0"></div>
        <div class="absolute top-1/3 right-[20%] w-1.5 h-1.5 bg-rose-300 rounded-full pulse-dot z-0" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-[40%] w-1 h-1 bg-fuchsia-300 rounded-full pulse-dot z-0" style="animation-delay: 0.5s;"></div>

        <!-- ✨ LADY IMAGE – fully visible on mobile, blends nicely on larger screens -->
        <div class="absolute right-0 bottom-0 w-full md:w-1/2 lg:w-2/5 h-full z-10 pointer-events-none">
            <img 
                src="{{ asset('images/tea-lady.png') }}" 
                alt="Elegant lady at tea party cruise" 
                class="absolute bottom-0 right-0 h-[85%] sm:h-[70%] md:h-[90%] w-auto object-contain opacity-90 sm:opacity-80 md:opacity-90 mix-blend-lighten"
            >
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 glass-card rounded-full px-4 py-2 mb-6 animate-fade-in-up border-rose-400/20">
                    <span class="w-2 h-2 bg-rose-400 rounded-full pulse-dot"></span>
                    <span class="text-xs sm:text-sm font-medium text-rose-200 tracking-widest uppercase">Exclusive Event • July 18th</span>
                </div>

                <!-- Headline -->
                <h1 class="font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-4 animate-fade-in-up animate-delay-1">
                    Tea Party<br>
                    <span class="gold-shimmer">Cruise</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg sm:text-xl md:text-2xl text-white/70 font-light mb-8 animate-fade-in-up animate-delay-2 max-w-lg leading-relaxed">
                    Join us for a delightful evening on the water — where elegance meets the golden horizon.
                </p>

                <!-- Event Details Card -->
                <div class="glass-card rounded-3xl p-5 sm:p-7 mb-8 animate-fade-in-up animate-delay-3 max-w-md">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-gold-400 text-2xl sm:text-3xl font-display font-bold">July 18</p>
                            <p class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-1">Date</p>
                        </div>
                        <div>
                            <p class="text-rose-400 text-2xl sm:text-3xl font-display font-bold">5:00 PM</p>
                            <p class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-1">Time</p>
                        </div>
                        <div>
                            <p class="text-fuchsia-400 text-2xl sm:text-3xl font-display font-bold">$200</p>
                            <p class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-1">Boarding</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up animate-delay-4">
                    <a href="{{ route('register') }}" class="tap-target px-8 py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold text-base sm:text-lg premium-shadow hover:shadow-xl hover:shadow-rose-500/40 transition-all duration-300 text-center inline-block">
                        Reserve Your Spot
                    </a>
                    <a href="#highlights" class="tap-target px-8 py-4 glass-card rounded-full text-white font-medium text-base sm:text-lg hover:bg-white/12 transition-all duration-300 text-center inline-block">
                        Learn More ↓
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom fade -->
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-[#0d0418] to-transparent z-10 pointer-events-none"></div>
    </section>

    <!-- ==================== COUNTDOWN SECTION ==================== -->
    <section class="py-12 sm:py-16 bg-[#0d0418] relative" id="countdown">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
            <p class="text-rose-300 text-sm uppercase tracking-[0.2em] mb-4 font-medium">Countdown to Departure</p>
            <div class="grid grid-cols-4 gap-3 sm:gap-5" id="countdownTimer">
                <div class="glass-card rounded-2xl p-4 sm:p-6">
                    <span class="block font-display text-3xl sm:text-5xl font-bold text-gold-400" id="days">00</span>
                    <span class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-2 block">Days</span>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6">
                    <span class="block font-display text-3xl sm:text-5xl font-bold text-rose-400" id="hours">00</span>
                    <span class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-2 block">Hours</span>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6">
                    <span class="block font-display text-3xl sm:text-5xl font-bold text-fuchsia-400" id="minutes">00</span>
                    <span class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-2 block">Minutes</span>
                </div>
                <div class="glass-card rounded-2xl p-4 sm:p-6">
                    <span class="block font-display text-3xl sm:text-5xl font-bold text-purple-400" id="seconds">00</span>
                    <span class="text-white/50 text-xs sm:text-sm uppercase tracking-wider mt-2 block">Seconds</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== EVENT HIGHLIGHTS ==================== -->
    <section class="py-16 sm:py-20 bg-[#120620]" id="highlights">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <p class="text-rose-300 text-sm uppercase tracking-[0.2em] mb-3 font-medium">Experience</p>
                <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold text-white">Event Highlights</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">🫖</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Premium Tea Service</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Sip on hand-selected loose-leaf teas served in fine bone china as the sun melts into the horizon.</p>
                </div>
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">🌅</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Sunset Views</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Witness breathtaking panoramic sunset views from the deck — the perfect backdrop for unforgettable moments.</p>
                </div>
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">🥂</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Gourmet Canapés</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Delight in a curated selection of gourmet bites, pastries, and desserts crafted by our executive pastry chef.</p>
                </div>
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">🎵</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Live Acoustic</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Soft live acoustic melodies set the mood as you mingle and unwind with fellow guests.</p>
                </div>
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">📸</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Photo Moments</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Capture stunning memories at our beautifully styled photo stations with professional lighting.</p>
                </div>
                <div class="glass-card rounded-3xl p-6 sm:p-8 text-center group cursor-default">
                    <div class="text-5xl mb-5">🎁</div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold mb-3 text-white">Luxury Gift Bag</h3>
                    <p class="text-white/60 leading-relaxed text-sm sm:text-base">Each guest receives a curated luxury gift bag with artisanal teas, treats, and a keepsake.</p>
                </div>
            </div>
        </div>
    </section>

<!-- ==================== GALLERY SECTION ==================== -->
<section class="py-16 sm:py-20 bg-[#0d0418]" id="gallery">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 sm:mb-16">
      <p class="text-rose-300 text-sm uppercase tracking-[0.2em] mb-3 font-medium">Moments</p>
      <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold text-white">Gallery</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-5">

      <!-- Item 1 -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative">
        <img
          src=" https://images.unsplash.com/photo-1710762633492-617ca7c87f2b?q=80"
          alt="Sunset Deck"
          class="absolute inset-0 w-full h-full object-cover"
          loading="eager"
          fetchpriority="high"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Sunset Deck</span>
      </div>

      <!-- Item 2 -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative">
        <img
          src="{{ asset('images/gallery/img2.jpeg') }}"
          alt="Tea Service"
          class="absolute inset-0 w-full h-full object-cover"
          loading="eager"
          fetchpriority="high"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Tea Service</span>
      </div>

      <!-- Item 3 -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative">
        <img
          src="{{ asset('images/gallery/img4.jpeg') }}"
          alt="Golden Hour"
          class="absolute inset-0 w-full h-full object-cover"
          loading="eager"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Golden Hour</span>
      </div>

      <!-- Item 4 - visible sm and up -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative sm:block hidden">
        <img
          src="{{ asset('images/gallery/img3.jpeg') }}"
          alt="Canapés"
          class="absolute inset-0 w-full h-full object-cover"
          loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Canapés</span>
      </div>

      <!-- Item 5 - visible lg and up -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative ">
        <img
          src="{{ asset('images/gallery/img5.jpeg') }}"
          alt="Live Music"
          class="absolute inset-0 w-full h-full object-cover"
          loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Live Music</span>
      </div>

      <!-- Item 6 - visible lg and up -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative ">
        <img
          src="{{ asset('images/gallery/img7.jpeg') }}"
          alt="Keepsakes"
          class="absolute inset-0 w-full h-full object-cover"
          loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Keepsakes</span>
      </div>

      <!-- Item 7 - visible sm and up -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative ">
        <img
          src="{{ asset('images/gallery/img6.jpeg') }}"
          alt="Evening Glow"
          class="absolute inset-0 w-full h-full object-cover"
          loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Evening Glow</span>
      </div>

      <!-- Item 8 -->
      <div class="gallery-card rounded-2xl overflow-hidden aspect-[3/4] relative">
        <img
          src="{{ asset('images/gallery/img1.jpeg') }}"
          alt="Cruise Views"
          class="absolute inset-0 w-full h-full object-cover"
          loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
        <span class="relative z-10 text-white text-xs sm:text-sm font-medium p-4">Cruise Views</span>
      </div>

    </div>
  </div>
</section>



<!-- ==================== CONTACT / RESERVE SECTION ==================== -->
<section class="py-16 sm:py-20 bg-[#0d0418]" id="contact">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <p class="text-rose-300 text-sm uppercase tracking-[0.2em] mb-3 font-medium">Join Us</p>
        <h2 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-6">Ready for an Unforgettable Evening?</h2>
        <p class="text-white/60 text-base sm:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
            Secure your spot aboard the most elegant tea party cruise of the season. Limited tickets available.
        </p>

        <!-- Contact Info: Phone & Email -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 mb-8 text-white/80 text-sm sm:text-base">
            <!-- Phone -->
            <a href="tel:+15551234567" class="inline-flex items-center gap-2 hover:text-rose-300 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-400 group-hover:text-rose-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span>+1 (952) 237-2668</span>
            </a>
            <!-- Divider (hidden on mobile) -->
            <span class="hidden sm:block text-white/20">|</span>
            <!-- Email -->
            <a href="mailto:Christelle@nsmedicalcourier.com" class="inline-flex items-center gap-2 hover:text-rose-300 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-400 group-hover:text-rose-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Christelle@nsmedicalcourier.com</span>
            </a>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="tap-target px-10 py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold text-lg premium-shadow hover:shadow-xl hover:shadow-rose-500/40 transition-all duration-300 inline-block">
                Reserve Your Spot
            </a>
            <a href="mailto:Christelle@nsmedicalcourier.com" class="tap-target px-10 py-4 glass-card rounded-full text-white font-medium text-lg hover:bg-white/12 transition-all duration-300 inline-block">
                Contact Us
            </a>
        </div>
    </div>
</section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="py-10 sm:py-12 bg-[#080310] border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2.5">
                    <span class="text-xl">🫖</span>
                    <span class="font-display text-lg font-bold text-white">TeaPartyCruise</span>
                </div>
                <div class="flex gap-6 text-sm text-white/50">
                    <a href="#" class="hover:text-rose-300 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-rose-300 transition-colors">Terms</a>
                    <a href="#" class="hover:text-rose-300 transition-colors">Contact</a>
                </div>
                <p class="text-white/30 text-xs sm:text-sm">&copy; 2026 Tea Party Cruise. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ==================== SCRIPTS ==================== -->
    <script>
        // Countdown Timer
        const targetDate = new Date('2026-07-18T17:00:00').getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            if (distance < 0) {
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                return;
            }
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById('days').textContent = String(days).padStart(2, '0');
            document.getElementById('hours').textContent = String(hours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Intersection Observer for scroll animations
        const observerOptions = { threshold: 0.15, rootMargin: '0px 0px -30px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        document.querySelectorAll('.glass-card, .gallery-card').forEach(el => {
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            observer.observe(el);
        });
        setTimeout(() => {
            document.querySelectorAll('.glass-card, .gallery-card').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }
            });
        }, 300);
    </script>nsmedicalcourier
</body>
</html>