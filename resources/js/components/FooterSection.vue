<script setup>

import { Link } from '@inertiajs/vue3';

</script>

<template>
    <footer class="bg-black/20 text-white py-12">
      <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">

        <div class="space-y-2">
            <div class="flex items-center">
            <Link
              href="/"
              class="flex items-center transform hover:scale-105 transition-transform duration-300 group"
            >
              <i class="fa-brands fa-bitcoin text-4xl text-yellow-400 group-hover:rotate-[360deg] transition-transform duration-700"></i>
              <span class="ml-3 text-xl font-bold text-white group-hover:text-yellow-400 transition-colors duration-300">TradeNow</span>
            </Link>
          </div>
          <p class="text-gray-300 text-sm">
            Empowering investors with cutting-edge technology and global market access.
          </p>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4 text-yellow-400">Quick Links</h4>
          <nav class="space-y-2">
            <a href="#market" class="text-gray-300 hover:text-white transition-colors">Markets</a>
          </nav>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4 text-yellow-400">Legal</h4>
          <nav class="space-y-2">
            <Link href="/terms" class="text-gray-300 hover:text-white transition-colors">Terms of Service</Link>
            <Link href="/privacy" class="block text-gray-300 hover:text-white transition-colors">Privacy Policy</Link>
            <Link href="/disclosure" class="block text-gray-300 hover:text-white transition-colors">Risk Disclosure</Link>
          </nav>
        </div>

        <div>
          <h4 class="text-lg font-semibold mb-4 text-yellow-400">Connect</h4>
          <div class="flex space-x-4 mb-4">
            <a href="#" class="text-2xl text-gray-300 hover:text-white transition-colors">
              <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="#" class="text-2xl text-gray-300 hover:text-white transition-colors">
              <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="#" class="text-2xl text-gray-300 hover:text-white transition-colors">
              <i class="fa-brands fa-facebook"></i>
            </a>
          </div>
          <p class="text-gray-300 text-sm">
            Support : support@tradenow.com
            <br />
            Phone : +1 (888) 456-7784
            <br />
            Address : 193 Shaw Rd, Middletown, NY 10941, États-Unis
          </p>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-6 mt-8 pt-6 border-t border-white/10 text-center">
        <p class="text-sm text-gray-400">
          © 2024 TradeNow. All Rights Reserved.
        </p>
      </div>
    </footer>
</template>
