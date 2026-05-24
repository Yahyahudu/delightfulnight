<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
  <title>Register — Tea Party Cruise</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            serif: ['Georgia', 'Cambria', 'Times New Roman', 'serif'],
            sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
            display: ['Playfair Display', 'Georgia', 'serif'],
          },
        },
      },
    }
  </script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap');

    body {
      font-family: 'Inter', system-ui, sans-serif;
    }

    .font-display {
      font-family: 'Playfair Display', Georgia, serif;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.06);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
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

    input,
    select,
    textarea {
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
      animation: fadeInUp 0.5s ease-out forwards;
    }

    .step-indicator {
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    /* Payment tab active style */
    .payment-tab-active {
      background: rgba(255, 255, 255, 0.15);
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      transform: translateY(-1px);
    }
  </style>
</head>

<body class="bg-[#0d0418] text-white font-sans antialiased min-h-screen overflow-x-hidden" x-data="registrationForm()">

  <!-- Background decorations -->
  <div class="fixed inset-0 bg-gradient-to-br from-[#1a0a2e] via-[#2d1b4e] to-[#4a1942] -z-10"></div>
  <div class="fixed inset-0 bg-gradient-to-t from-[#0d0418]/80 via-transparent to-transparent -z-10"></div>

  <!-- ✨ LADY IMAGE -->
  <div class="fixed right-0 bottom-0 w-full md:w-1/3 lg:w-1/4 h-full pointer-events-none z-0 opacity-30 md:opacity-40">
    <img 
      src="{{ asset('images/tea-lady.png') }}" 
      alt="Elegant lady" 
      class="absolute bottom-0 right-0 h-[50%] md:h-[70%] w-auto object-contain mix-blend-lighten"
    >
  </div>

  <!-- Main container -->
  <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-8 sm:py-12">
    <a href="{{ route('landing') }}"
      class="self-start max-w-lg w-full mx-auto mb-4 text-white/60 hover:text-rose-300 transition-colors text-sm flex items-center gap-2 tap-target">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Event
    </a>

    <!-- Registration form card (before confirmation) -->
    <div class="w-full max-w-lg glass-card rounded-3xl p-6 sm:p-8 md:p-10 premium-shadow" x-show="!showConfirmation"
      x-transition>

      <!-- Step indicators (now only 2 steps) -->
      <div class="flex items-center justify-center gap-3 mb-8">
        <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold"
          :class="step >= 1 ? 'bg-fuchsia-500 text-white' : 'bg-white/10 text-white/40'">1</div>
        <div class="w-10 h-0.5 rounded-full" :class="step >= 2 ? 'bg-fuchsia-500' : 'bg-white/10'"></div>
        <div class="step-indicator w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold"
          :class="step >= 2 ? 'bg-fuchsia-500 text-white' : 'bg-white/10 text-white/40'">2</div>
      </div>

      <!-- Step 1: Personal Details -->
      <div x-show="step === 1" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-x-6" x-transition:enter-end="opacity-100 translate-x-0">
        <h2 class="font-display text-2xl sm:text-3xl font-bold mb-1">Your Details</h2>
        <p class="text-white/50 text-sm mb-6">Fill in your details to begin</p>
        <form @submit.prevent="submitStep1()" class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-white/70 mb-1.5">Full Name *</label>
            <input type="text" x-model="form.name" required
              class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3.5 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all"
              placeholder="Enter your full name">
          </div>
          <div>
            <label class="block text-sm font-medium text-white/70 mb-1.5">Phone Number *</label>
            <input type="tel" x-model="form.phone" required
              class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3.5 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all"
              placeholder="+1 (555) 000-0000">
          </div>
          <div>
            <label class="block text-sm font-medium text-white/70 mb-1.5">Email Address *</label>
            <input type="email" x-model="form.email" required
              class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3.5 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all"
              placeholder="you@example.com">
          </div>
          <div>
            <label class="block text-sm font-medium text-white/70 mb-1.5">Number of Tickets *</label>
            <select x-model.number="form.tickets" required
              class="w-full bg-white/5 border border-white/15 rounded-xl px-4 py-3.5 text-white focus:outline-none focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-500/20 transition-all appearance-none">
              <option value="1" class="bg-[#2d1b4e]">1 Ticket ($200)</option>
              <option value="2" class="bg-[#2d1b4e]">2 Tickets ($400)</option>
              <option value="3" class="bg-[#2d1b4e]">3 Tickets ($600)</option>
              <option value="4" class="bg-[#2d1b4e]">4 Tickets ($800)</option>
            </select>
          </div>
          
          <!-- Submit button with loading -->
          <button type="submit"
            :disabled="submittingStep1"
            class="tap-target w-full mt-2 py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold text-lg premium-shadow hover:shadow-xl hover:shadow-rose-500/40 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed">
            <span x-show="!submittingStep1">Proceed to Payment</span>
            <span x-show="submittingStep1" class="flex items-center justify-center gap-2">
              <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
              </svg>
              Processing...
            </span>
          </button>
        </form>
        <p x-show="error" x-text="error" class="text-rose-400 text-sm mt-4"></p>
      </div>

      <!-- Step 2: Payment & Finalize (combined) -->
      <div x-show="step === 2" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 translate-x-6" x-transition:enter-end="opacity-100 translate-x-0"
        style="display: none;">
        <h2 class="font-display text-2xl sm:text-3xl font-bold mb-1">Complete Payment</h2>
        <p class="text-white/50 text-sm mb-6">Choose your payment method and scan the QR code</p>

        <!-- Payment Tabs -->
        <div class="glass-card rounded-2xl p-5 sm:p-6 text-center">
          <!-- Tab buttons -->
          <div class="flex gap-2 mb-6 bg-white/5 p-1 rounded-full">
            <button 
              @click="activePaymentTab = 'cashapp'"
              :class="activePaymentTab === 'cashapp' ? 'payment-tab-active' : ''"
              class="flex-1 py-2.5 px-4 rounded-full text-sm font-medium transition-all duration-300"
            >
              Cash App 
            </button>
            <button 
              @click="activePaymentTab = 'zelle'"
              :class="activePaymentTab === 'zelle' ? 'payment-tab-active' : ''"
              class="flex-1 py-2.5 px-4 rounded-full text-sm font-medium transition-all duration-300"
            >
              🏦 Zelle
            </button>
          </div>

          <!-- Cash App Content -->
          <div x-show="activePaymentTab === 'cashapp'" x-transition>
            <div class="bg-white rounded-xl p-3 inline-block mx-auto mb-4">
              <img src="{{ asset('images/qr.jpg') }}" alt="Cash App QR Code" class="w-[180px] h-[180px] object-contain">
            </div>
            <p class="text-gold-400 font-display text-2xl font-bold mb-2">$christabreland</p>
            <p class="text-white/60 text-sm mb-4">
              Total: <span class="text-white font-bold">$<span x-text="form.tickets * 200"></span></span>
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
              <button @click="copyCashTag()"
                class="tap-target px-5 py-3 glass-card rounded-full text-white text-sm font-medium hover:bg-white/12 transition-all flex items-center gap-2 justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <rect x="9" y="9" width="13" height="13" rx="2" stroke-width="2" />
                  <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke-width="2" />
                </svg>
                <span x-text="copyTagText">Copy Tag</span>
              </button>
              <button @click="copyCashLink()"
                class="tap-target px-5 py-3 glass-card rounded-full text-white text-sm font-medium hover:bg-white/12 transition-all flex items-center gap-2 justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101" />
                </svg>
                <span x-text="copyLinkText">Copy Link</span>
              </button>
            </div>
          </div>

          <!-- Zelle Content -->
          <div x-show="activePaymentTab === 'zelle'" x-transition>
            <div class="bg-white rounded-xl p-3 inline-block mx-auto mb-4">
              <img src="{{ asset('images/zelle-qr.jpg') }}" alt="Zelle QR Code" class="w-[180px] h-[180px] object-contain">
            </div>
            <p class="text-gold-400 font-display text-2xl font-bold mb-2">Christa Breland</p>
            <p class="text-white/60 text-sm mb-4">
              Total: <span class="text-white font-bold">$<span x-text="form.tickets * 200"></span></span>
            </p>
          </div>
          
          <p x-show="copySuccess" class="text-green-400 text-sm mt-3" x-text="copySuccess"></p>
        </div>

        <!-- Finalize button (outside tabs, same for both) -->
        <button @click="finalizeRegistration()"
          :disabled="submitting"
          class="tap-target w-full mt-5 py-4 bg-gradient-to-r from-fuchsia-600 to-rose-500 rounded-full text-white font-semibold text-lg premium-shadow hover:shadow-xl hover:shadow-rose-500/40 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed">
          <span x-show="!submitting">I Have Completed Payment</span>
          <span x-show="submitting" class="flex items-center justify-center gap-2">
            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
            </svg>
            Submitting...
          </span>
        </button>
      </div>
    </div>

    <!-- Confirmation screen -->
    <div x-show="showConfirmation" x-transition:enter="transition ease-out duration-500"
      x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
      class="w-full max-w-lg glass-card rounded-3xl p-6 sm:p-8 md:p-10 premium-shadow text-center"
      style="display: none;">
      <div class="text-6xl mb-4">🎉</div>
      <h2 class="font-display text-2xl sm:text-3xl font-bold mb-2">Registration Submitted!</h2>
      <p class="text-white/60 mb-6">Your ticket request is pending verification.</p>
      <div class="glass-card rounded-2xl p-5 mb-6 text-left space-y-3">
        <div class="flex justify-between">
          <span class="text-white/50 text-sm">Registration ID</span>
          <span class="font-mono text-gold-400 font-bold text-sm" x-text="confirmationData.registration_id">—</span>
        </div>
        <div class="flex justify-between">
          <span class="text-white/50 text-sm">Ticket Number</span>
          <span class="font-mono text-rose-400 font-bold text-sm" x-text="confirmationData.ticket_number">—</span>
        </div>
        <div class="flex justify-between">
          <span class="text-white/50 text-sm">Total Paid</span>
          <span class="font-bold text-sm" x-text="'$' + (form.tickets * 200)">—</span>
        </div>
      </div>
      <p class="text-white/40 text-xs mb-6">A confirmation email will be sent to <span x-text="form.email"
          class="text-rose-300">—</span></p>
      <a href="{{ route('landing') }}"
        class="tap-target inline-block px-8 py-3.5 glass-card rounded-full text-white font-medium hover:bg-white/10 transition-all">Back
        to Event</a>
    </div>
  </div>

  <!-- Toast notification -->
  <div x-show="toast.show" x-transition:enter="transition ease-out duration-400"
    x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 px-6 py-3.5 rounded-full text-sm font-medium shadow-2xl"
    :class="toast.type === 'success' ? 'bg-green-500/90 text-white' : 'bg-rose-500/90 text-white'"
    x-text="toast.message" style="display: none;"></div>

  <script>
    function registrationForm() {
      return {
        step: 1,
        form: { name: '', phone: '', email: '', tickets: 1, notes: '' },
        error: '',
        registrationDbId: null,
        showConfirmation: false,
        confirmationData: { registration_id: '', ticket_number: '' },
        // Payment tab
        activePaymentTab: 'cashapp',
        // Cash App copy state
        copyTagText: 'Copy Tag',
        copyLinkText: 'Copy Link',
        // Zelle copy state
        zelleCopyText: 'Copy Zelle Info',
        zelleDetail: 'christabreland', 
        copySuccess: '',
        submitting: false,
        submittingStep1: false,
        toast: { show: false, message: '', type: 'success' },

        copyCashTag() {
          navigator.clipboard.writeText('$TeaPartyCruise').then(() => {
            this.copyTagText = 'Copied!';
            this.copySuccess = 'Cash App tag copied!';
            setTimeout(() => { this.copyTagText = 'Copy Tag'; this.copySuccess = ''; }, 2000);
          }).catch(() => {
            this.copyTagText = 'Failed';
            setTimeout(() => { this.copyTagText = 'Copy Tag'; }, 2000);
          });
        },
        copyCashLink() {
          navigator.clipboard.writeText('https://cash.app/$christabreland?qr=1').then(() => {
            this.copyLinkText = 'Copied!';
            this.copySuccess = 'Payment link copied!';
            setTimeout(() => { this.copyLinkText = 'Copy Link'; this.copySuccess = ''; }, 2000);
          }).catch(() => {
            this.copyLinkText = 'Failed';
            setTimeout(() => { this.copyLinkText = 'Copy Link'; }, 2000);
          });
        },
       

        async submitStep1() {
          this.error = '';
          this.submittingStep1 = true;
          const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          try {
            const res = await fetch('/api/register/store', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
              },
              body: JSON.stringify(this.form)
            });
            const data = await res.json();
            if (data.success) {
              this.registrationDbId = data.id;
              this.confirmationData.registration_id = data.registration_id;
              this.confirmationData.ticket_number = data.ticket_number;
              this.step = 2;
            } else {
              this.error = data.message || 'Registration failed. Please try again.';
            }
          } catch (err) {
            this.error = 'Network error. Please try again.';
          } finally {
            this.submittingStep1 = false;
          }
        },

        async finalizeRegistration() {
          if (!this.registrationDbId) {
            this.showToast('Invalid registration session.', 'error');
            return;
          }
          const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          this.submitting = true;
          try {
            const res = await fetch(`/api/register/finalize/${this.registrationDbId}`, {
              method: 'POST',
              headers: { 'X-CSRF-TOKEN': csrf }
            });
            const data = await res.json();
            if (data.success) {
              this.showConfirmation = true;
              this.showToast('Registration submitted successfully!', 'success');
            } else {
              this.showToast(data.message || 'Verification failed. Please try again.', 'error');
            }
          } catch (err) {
            this.showToast('Network error. Please try again.', 'error');
          } finally {
            this.submitting = false;
          }
        },

        showToast(message, type = 'success') {
          this.toast = { show: true, message, type };
          setTimeout(() => { this.toast.show = false; }, 3500);
        }
      };
    }
  </script>
</body>

</html>