<script setup>

import { Link } from '@inertiajs/vue3';

const features = [
    {
        icon: 'fa-solid fa-chart-simple',
        title: 'Real-time Analytics',
        description: 'Get instant market insights with our advanced charting tools and live data streams.'
    },
    {
        icon: 'fa-solid fa-shield',
        title: 'Secure Trading',
        description: 'Bank-level security and encryption to protect your investments and personal data.'
    },
    {
        icon: 'fa-solid fa-globe',
        title: 'Global Markets',
        description: 'Trade across multiple markets, from stocks and crypto to forex and commodities.'
    }
];

</script>

<template>
    <div class="min-h-screen text-white">
      <!-- Hero Section -->
      <div class="max-w-7xl mx-auto px-6 pt-24 pb-16 flex flex-col gap-10 md:flex-row items-center">
        <!-- Text Content -->
        <div class="flex-1 space-y-6 text-center md:text-left animate-fade-in-left">
          <h1 class="text-4xl md:text-5xl font-bold leading-tight">
            Trade Smarter,
            <span class="block text-yellow-400">Invest Confidently</span>
          </h1>

          <p class="text-xl text-gray-300 mb-6">
            Unlock the potential of financial markets with real-time insights,
            advanced analytics, and seamless trading experiences.
          </p>

          <div class="flex space-x-4 justify-center md:justify-start">
            <Link
              href="/first"
              class="px-6 py-3 bg-yellow-400 text-blue-900 rounded-lg hover:bg-yellow-500 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-semibold"
            >
              Get Started
            </Link>
            <a
              href="#market"
              class="px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white hover:text-blue-900 transition-all duration-300 transform hover:scale-105 hover:shadow-xl font-semibold"
            >
              Explore Markets
            </a>
          </div>
        </div>

        <!-- Animated Hero Image -->
        <div class="md:w-1/2 mb-8 md:mb-0 relative animate-fade-in-right flex items-center justify-end gap-4">

          <div class="bg-blue-600/30 absolute -inset-4 rounded-full blur-2xl animate-pulse"></div>

          <!-- Floating Stats Badges -->
          <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 shadow-lg animate-float">
            <div class="flex items-center space-x-3">
              <i class="fa-solid fa-chart-line text-yellow-400 text-3xl"></i>
              <div>
                <p class="text-sm text-gray-200">Total Trading Volume</p>
                <p class="text-xl font-bold text-white">$542M</p>
              </div>
            </div>
          </div>

          <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 shadow-lg animate-float delay-500">
            <div class="flex items-center space-x-3">
              <i class="fa-solid fa-users text-green-400 text-3xl"></i>
              <div>
                <p class="text-sm text-gray-200">Active Traders</p>
                <p class="text-xl font-bold text-white">42,567</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Features Section -->
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">
          Why Choose TradeNow?
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
          <div
            v-for="feature in features"
            :key="feature.title"
            class="bg-white/10 backdrop-blur-md rounded-2xl p-6 text-center transform transition-all duration-300 hover:scale-105 hover:bg-white/20"
          >
            <div class="text-5xl mb-4 text-center">
              <i :class="feature.icon" class="text-yellow-400"></i>
            </div>
            <h3 class="text-xl font-bold mb-3">{{ feature.title }}</h3>
            <p class="text-gray-300">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </div>
</template>

  <style scoped>
  /* Custom Animations */
  @keyframes fadeInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes fadeInRight {
    from { opacity: 0; transform: translateX(50px); }
    to { opacity: 1; transform: translateX(0); }
  }

  @keyframes floatAnimation {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
  }

  .animate-fade-in-left {
    animation: fadeInLeft 1s ease-out;
  }

  .animate-fade-in-right {
    animation: fadeInRight 1s ease-out;
  }

  .animate-float {
    animation: floatAnimation 4s ease-in-out infinite;
  }

  .animate-pulse {
    animation: pulse 4s infinite;
  }

  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }
  </style>
