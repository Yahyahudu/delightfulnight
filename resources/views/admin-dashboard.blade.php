<!DOCTYPE html>
<html lang="en" class="scroll-smooth" x-data="{ darkMode: false }" :class="darkMode ? 'dark' : ''">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — Tea Party Cruise</title>
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
            },
            darkMode: 'class',
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
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-sidebar {
            background: rgba(18, 6, 32, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }
        .tap-target {
            min-height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar-link {
            transition: all 0.2s ease;
            border-radius: 12px;
        }
        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.06);
        }
        .sidebar-link.active {
            background: rgba(217, 70, 239, 0.2);
            color: #e879f9;
        }
        @media (max-width: 1023px) {
            .sidebar-overlay {
                background: rgba(0, 0, 0, 0.6);
                backdrop-filter: blur(4px);
            }
        }
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:active {
            transform: scale(0.97);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .bar-chart-bar {
            transition: height 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
    </style>
</head>
<body class="bg-[#0d0418] text-white font-sans antialiased min-h-screen overflow-x-hidden"
      :class="darkMode ? 'bg-[#050210]' : 'bg-[#0d0418]'" x-data="adminDashboard()">
    <!-- ==================== MOBILE SIDEBAR OVERLAY ==================== -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-40 sidebar-overlay lg:hidden"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         style="display: none;"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="fixed top-0 left-0 h-full w-72 z-50 glass-sidebar transform transition-transform duration-300 ease-in-out lg:translate-x-0 flex flex-col"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between px-5 py-5 border-b border-white/5">
            <div class="flex items-center gap-2.5">
                <span class="text-2xl">🫖</span>
                <span class="font-display text-lg font-bold">TeaParty<span class="text-rose-400">Cruise</span></span>
            </div>
            <button @click="sidebarOpen = false" class="lg:hidden tap-target text-white/50 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <!-- Sidebar Nav -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="#" @click.prevent="activeSection='dashboard'; sidebarOpen=false"
               class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium"
               :class="activeSection==='dashboard'?'active text-fuchsia-300':'text-white/60'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="2"/></svg>
                Dashboard
            </a>
            <a href="#" @click.prevent="activeSection='attendees'; sidebarOpen=false"
               class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium"
               :class="activeSection==='attendees'?'active text-fuchsia-300':'text-white/60'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Attendees
            </a>
            <a href="#" @click.prevent="activeSection='announcements'; sidebarOpen=false"
               class="sidebar-link flex items-center gap-3 px-4 py-3 text-sm font-medium"
               :class="activeSection==='announcements'?'active text-fuchsia-300':'text-white/60'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Announcements
            </a>
        </nav>
        <!-- Sidebar Footer -->
        <div class="px-3 py-4 border-t border-white/5">
            <div class="flex items-center gap-3 px-4 py-3">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-fuchsia-500 to-rose-500 flex items-center justify-center text-sm font-bold">A</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">Admin User</p>
                    <p class="text-xs text-white/40 truncate">admin@cruise.com</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="lg:pl-72 min-h-screen flex flex-col">
        <!-- Top Navbar -->
        <header class="sticky top-0 z-30 glass-card border-b border-white/5 px-4 sm:px-6 py-3 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden tap-target text-white/70 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="relative hidden sm:block">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M21 21l-4.35-4.35"/></svg>
                    <input type="search" placeholder="Search..." class="bg-white/5 border border-white/10 rounded-xl pl-10 pr-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 w-48 lg:w-64 transition-all">
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" class="tap-target text-white/60 hover:text-white transition-colors relative w-10 h-10">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;"><circle cx="12" cy="12" r="5" stroke-width="2"/><path stroke-linecap="round" stroke-width="2" d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                </button>
                <!-- Notifications -->
                <button class="tap-target relative text-white/60 hover:text-white transition-colors w-10 h-10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                </button>
                <!-- Profile -->
                <button class="tap-target flex items-center gap-2 text-sm font-medium text-white/70 hover:text-white transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-fuchsia-500 to-rose-500 flex items-center justify-center text-xs font-bold">A</div>
                    <span class="hidden sm:inline">Admin</span>
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- ========== DASHBOARD SECTION ========== -->
            <div x-show="activeSection === 'dashboard'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <h1 class="font-display text-2xl sm:text-3xl font-bold mb-6">Dashboard Overview</h1>
                <!-- Stat Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 mb-6">
                    <div class="stat-card glass-card rounded-2xl p-4 sm:p-5">
                        <p class="text-white/40 text-xs uppercase tracking-wider mb-2">Tickets Sold</p>
                        <p class="text-3xl sm:text-4xl font-display font-bold text-gold-400" x-text="stats.total_tickets_sold"></p>
                        <p class="text-green-400 text-xs mt-1">+12% from last week</p>
                    </div>
                    <div class="stat-card glass-card rounded-2xl p-4 sm:p-5">
                        <p class="text-white/40 text-xs uppercase tracking-wider mb-2">Revenue</p>
                        <p class="text-3xl sm:text-4xl font-display font-bold text-rose-400" x-text="'$' + (stats.total_revenue / 1000).toFixed(1) + 'K'"></p>
                        <p class="text-green-400 text-xs mt-1">+8% from last week</p>
                    </div>
                    <div class="stat-card glass-card rounded-2xl p-4 sm:p-5">
                        <p class="text-white/40 text-xs uppercase tracking-wider mb-2">Total Attendees</p>
                        <p class="text-3xl sm:text-4xl font-display font-bold text-fuchsia-400" x-text="stats.confirmed_attendees"></p>
                        <p class="text-white/40 text-xs mt-1">Confirmed guests</p>
                    </div>
                    <div class="stat-card glass-card rounded-2xl p-4 sm:p-5">
                        <p class="text-white/40 text-xs uppercase tracking-wider mb-2">Remaining Seats</p>
                        <p class="text-3xl sm:text-4xl font-display font-bold text-purple-400" x-text="stats.remaining_capacity"></p>
                        <p class="text-rose-400 text-xs mt-1">Out of 200 capacity</p>
                    </div>
                </div>

                <!-- Recent Activity Feed with Action Confirm Button -->
                <div class="glass-card rounded-2xl p-5 sm:p-6">
                    <h3 class="font-semibold text-white mb-4">Recent Registrations</h3>
                    <div class="space-y-3">
                        <template x-for="reg in recentRegistrations" :key="reg.id">
                            <div class="flex items-center justify-between py-3 border-b border-white/5 last:border-0">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-fuchsia-500/40 to-rose-500/40 flex items-center justify-center text-xs font-bold flex-shrink-0" x-text="reg.initials"></div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium truncate" x-text="reg.name"></p>
                                        <p class="text-xs text-white/40 truncate" x-text="reg.email"></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 flex-shrink-0 ml-3">
                                    <span class="text-xs text-white/30" x-text="reg.time"></span>
                                    <!-- Confirm Button / Confirmed State -->
                                    <button @click="confirmRegistration(reg.id)"
                                            x-show="reg.status !== 'confirmed'"
                                            class="tap-target px-3 py-1.5 bg-fuchsia-500/20 text-fuchsia-300 text-xs rounded-full hover:bg-fuchsia-500/30 transition-all whitespace-nowrap">
                                        Confirm
                                    </button>
                                    <span x-show="reg.status === 'confirmed'"
                                          class="text-green-400 text-xs flex items-center gap-1 whitespace-nowrap">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Confirmed
                                    </span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- ========== ATTENDEES SECTION ========== -->
            <div x-show="activeSection === 'attendees'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 style="display:none;">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <h1 class="font-display text-2xl sm:text-3xl font-bold">Attendees</h1>
                    <div class="flex gap-2">
                        <input type="search" x-model="attendeeSearch" placeholder="Search attendees..."
                               class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400 flex-1 sm:w-56">
                        <select x-model="attendeeFilter"
                                class="bg-white/5 border border-white/10 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:border-fuchsia-400">
                            <option value="all" class="bg-[#1a0a2e]">All</option>
                            <option value="confirmed" class="bg-[#1a0a2e]">Confirmed</option>
                            <option value="pending" class="bg-[#1a0a2e]">Pending</option>
                        </select>
                    </div>
                </div>
                <!-- Desktop Table -->
                <div class="hidden md:block glass-card rounded-2xl overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="text-left px-5 py-3.5 font-medium text-white/50 text-xs uppercase tracking-wider cursor-pointer hover:text-white transition-colors" @click="sortBy('name')">Name <span class="ml-1">↕</span></th>
                                <th class="text-left px-5 py-3.5 font-medium text-white/50 text-xs uppercase tracking-wider">Email</th>
                                <th class="text-left px-5 py-3.5 font-medium text-white/50 text-xs uppercase tracking-wider">Tickets</th>
                                <th class="text-left px-5 py-3.5 font-medium text-white/50 text-xs uppercase tracking-wider">Status</th>
                                <th class="text-left px-5 py-3.5 font-medium text-white/50 text-xs uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="a in filteredAttendees" :key="a.id">
                                <tr class="border-t border-white/5 hover:bg-white/3 transition-colors">
                                    <td class="px-5 py-3.5 font-medium" x-text="a.name"></td>
                                    <td class="px-5 py-3.5 text-white/50" x-text="a.email"></td>
                                    <td class="px-5 py-3.5" x-text="a.tickets"></td>
                                    <td class="px-5 py-3.5">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium"
                                              :class="a.status==='confirmed'?'bg-green-500/15 text-green-400':'bg-yellow-500/15 text-yellow-400'"
                                              x-text="a.status"></span>
                                    </td>
                                    <td class="px-5 py-3.5 text-white/30 text-xs" x-text="a.date"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <!-- Mobile Cards -->
                <div class="md:hidden space-y-3">
                    <template x-for="a in filteredAttendees" :key="a.id">
                        <div class="glass-card rounded-2xl p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-semibold" x-text="a.name"></span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium"
                                      :class="a.status==='confirmed'?'bg-green-500/15 text-green-400':'bg-yellow-500/15 text-yellow-400'"
                                      x-text="a.status"></span>
                            </div>
                            <p class="text-white/50 text-sm" x-text="a.email"></p>
                            <div class="flex justify-between mt-2 text-xs text-white/30">
                                <span x-text="a.tickets + ' ticket(s)'"></span>
                                <span x-text="a.date"></span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- ========== ANNOUNCEMENTS / REMINDERS SECTION ========== -->
            <div x-show="activeSection === 'announcements'"
                 x-transition:enter="transition ease-out duration-400"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 style="display:none;">
                <h1 class="font-display text-2xl sm:text-3xl font-bold mb-6">Send Announcement / Reminder</h1>
                <div class="glass-card rounded-2xl p-6 max-w-2xl">
                    <form @submit.prevent="sendReminder" class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-white/60 mb-2">Heading</label>
                            <input type="text" x-model="reminderHeading" required
                                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400"
                                   placeholder="Reminder subject...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-white/60 mb-2">Message</label>
                            <textarea x-model="reminderMessage" rows="5" required
                                      class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/30 focus:outline-none focus:border-fuchsia-400"
                                      placeholder="Your message..."></textarea>
                        </div>
                        <button type="submit"
                                class="px-6 py-3 bg-fuchsia-600 hover:bg-fuchsia-700 text-white font-medium rounded-xl transition-colors"
                                :disabled="reminderSending">
                            <span x-show="!reminderSending">Send to confirmed guests</span>
                            <span x-show="reminderSending">Sending...</span>
                        </button>
                    </form>
                    <div x-show="reminderSent" class="mt-4 text-green-400 text-sm">Reminder sent successfully!</div>
                    <div x-show="reminderError" class="mt-4 text-rose-400 text-sm" x-text="reminderError"></div>
                </div>
            </div>

        </main>
    </div>

    <script>
        function adminDashboard() {
            return {
                sidebarOpen: false,
                darkMode: false,
                activeSection: 'dashboard',
                attendeeSearch: '',
                attendeeFilter: 'all',
                sortField: 'name',
                sortDir: 'asc',

                // Real data from backend
                stats: @json($stats),
                attendees: @json($attendees),
                recentRegistrations: @json($recentRegistrations),

                // Reminder form
                reminderHeading: '',
                reminderMessage: '',
                reminderSending: false,
                reminderSent: false,
                reminderError: '',

                get filteredAttendees() {
                    let list = this.attendees;
                    if (this.attendeeFilter === 'confirmed') list = list.filter(a => a.status === 'confirmed');
                    if (this.attendeeFilter === 'pending') list = list.filter(a => a.status === 'pending');
                    if (this.attendeeSearch) {
                        const q = this.attendeeSearch.toLowerCase();
                        list = list.filter(a => a.name.toLowerCase().includes(q) || a.email.toLowerCase().includes(q));
                    }
                    return list.sort((a, b) => {
                        const va = a[this.sortField] || '';
                        const vb = b[this.sortField] || '';
                        return this.sortDir === 'asc' ? va.localeCompare(vb) : vb.localeCompare(va);
                    });
                },

                sortBy(field) {
                    if (this.sortField === field) {
                        this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
                    } else {
                        this.sortField = field;
                        this.sortDir = 'asc';
                    }
                },

                async confirmRegistration(id) {
                    try {
                        const response = await fetch(`/admin/confirm/${id}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });
                        if (response.ok) {
                            // Update local data
                            const reg = this.recentRegistrations.find(r => r.id == id);
                            if (reg) reg.status = 'confirmed';
                            const att = this.attendees.find(a => a.id == id);
                            if (att) att.status = 'confirmed';
                        }
                    } catch (error) {
                        console.error('Confirmation failed:', error);
                    }
                },

                async sendReminder() {
                    this.reminderSending = true;
                    this.reminderSent = false;
                    this.reminderError = '';
                    try {
                        const response = await fetch('/admin/reminder', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                heading: this.reminderHeading,
                                message: this.reminderMessage
                            })
                        });
                        if (response.ok) {
                            this.reminderSent = true;
                            this.reminderHeading = '';
                            this.reminderMessage = '';
                        } else {
                            const data = await response.json();
                            this.reminderError = data.message || 'Something went wrong.';
                        }
                    } catch (error) {
                        this.reminderError = 'Network error. Please try again.';
                    }
                    this.reminderSending = false;
                }
            };
        }
    </script>
</body>
</html>