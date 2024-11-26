<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const isScrolling = ref(false);
const isDropdownOpen = ref(false);
const isMobileMenuOpen = ref(false);

const handleScroll = () => {
  const currentScrollY = window.scrollY
  isScrolling.value = currentScrollY !== 0;
};

const navLinks = [
  { href: '#market', icon: 'fa-solid fa-chart-simple', label: 'Markets' }
];

const authLinks = [
  {
    href: '/login',
    label: 'Login',
    class: 'bg-yellow-400 text-blue-900 hover:bg-yellow-500'
  },
  {
    href: '/first',
    label: 'Register',
    class: 'border border-yellow-400 text-yellow-400 hover:bg-blue-900'
  }
];

const userDropdownItems = [
  {
    href: '/dashboard',
    icon: 'fa-solid fa-house',
    label: 'Dashboard',
    action: () => {}
  },
  {
    href: '',
    icon: 'fa-solid fa-right-from-bracket',
    label: 'Logout',
    action: () => router.delete('/logout')
  }
];

const toggleDropdown = (event) => {
  event.stopPropagation();
  isDropdownOpen.value = !isDropdownOpen.value;
};

const toggleMobileMenu = (event) => {
  event.stopPropagation();
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const handleClickOutside = (event) => {
  const dropdown = document.querySelector('.dropdown-container');
  const mobileMenu = document.querySelector('.mobile-menu-container');
  const menuToggle = document.querySelector('.mobile-menu-toggle');

  if (dropdown && !dropdown.contains(event.target)) {
    isDropdownOpen.value = false;
  }

  if (mobileMenu && !mobileMenu.contains(event.target) &&
      menuToggle && !menuToggle.contains(event.target)) {
    isMobileMenuOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
  window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
  <nav :class="{'bg-black/50 shadow-2xl': isScrolling}" class="text-white sticky top-0 z-50 transition-all duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <!-- Logo -->
        <div class="flex items-center">
          <Link
            href="/"
            class="flex items-center transform hover:scale-105 transition-transform duration-300 group"
          >
            <i class="fa-brands fa-bitcoin text-4xl text-yellow-400 group-hover:rotate-[360deg] transition-transform duration-700"></i>
            <span class="ml-3 text-xl font-bold text-white group-hover:text-yellow-400 transition-colors duration-300">TradeNow</span>
          </Link>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex space-x-8 items-center">
          <a
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="relative group text-white hover:text-yellow-400 transition-colors duration-300 ease-in-out"
          >
            <div class="flex items-center space-x-2">
              <i :class="link.icon" class="text-2xl transform transition-transform group-hover:scale-110"></i>
              <span class="relative">
                {{ link.label }}
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-yellow-400 transition-all duration-300 group-hover:w-full"></span>
              </span>
            </div>
          </a>
        </div>

        <!-- Desktop Authentication/User Menu -->
        <div class="hidden md:flex items-center">
          <template v-if="!$page.props.auth.user">
            <div class="flex space-x-4">
              <Link
                v-for="authLink in authLinks"
                :key="authLink.href"
                :href="authLink.href"
                :class="authLink.class"
                class="px-4 py-2 rounded-md transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-xs sm:text-base"
              >
                {{ authLink.label }}
              </Link>
            </div>
          </template>
          <template v-else>
            <div class="relative dropdown-container">
              <button
                @click="toggleDropdown"
                class="flex items-center space-x-2 hover:bg-blue-800 p-2 rounded-md transition-all duration-300 ease-in-out transform hover:scale-105"
              >
                <i class="fa-solid fa-circle-user text-3xl text-yellow-400"></i>
                <span class="font-medium">{{ $page.props.auth.user.name }}</span>
                <i
                  class="fa-solid fa-caret-down ml-2 transition-transform duration-300"
                  :class="{ 'rotate-180': isDropdownOpen }"
                ></i>
              </button>

              <transition
                enter-active-class="transition ease-out duration-300"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition ease-in duration-200"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
              >
                <div
                  v-if="isDropdownOpen"
                  class="absolute right-0 mt-2 w-56 origin-top-right bg-white text-gray-800 border border-gray-200 rounded-md shadow-2xl"
                >
                  <div class="py-1">
                    <Link
                      v-for="dropdownItem in userDropdownItems"
                      :key="dropdownItem.href"
                      :href="dropdownItem.href"
                      @click="dropdownItem.action"
                      class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 transition-all duration-300"
                    >
                      <i :class="dropdownItem.icon" class="mr-3 text-xl"></i>
                      {{ dropdownItem.label }}
                    </Link>
                  </div>
                </div>
              </transition>
            </div>
          </template>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="md:hidden flex items-center mobile-menu-toggle">
          <button
            @click="toggleMobileMenu"
            class="text-white hover:text-yellow-400 transition-colors duration-300"
          >
            <i
              :class="isMobileMenuOpen
                ? 'fa-solid fa-xmark'
                : 'fa-solid fa-bars'"
              class="text-3xl"
            ></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu Slide-out -->
    <transition
      enter-active-class="transition ease-out duration-300"
      enter-from-class="opacity-0 translate-x-full"
      enter-to-class="opacity-100 translate-x-0"
      leave-active-class="transition ease-in duration-200"
      leave-from-class="opacity-100 translate-x-0"
      leave-to-class="opacity-0 translate-x-full"
    >
      <div
        v-if="isMobileMenuOpen"
        class="mobile-menu-container mobile-menu fixed top-16 right-0 w-3/4 h-[calc(100vh-4rem)] bg-blue-900/90 backdrop-blur-md p-4 z-50 overflow-y-auto space-y-4"
        @click.stop
      >
        <!-- Mobile Authentication/User Menu -->
        <template v-if="!$page.props.auth.user">
          <div class="space-y-4">
            <Link
              v-for="authLink in authLinks"
              :key="authLink.href"
              :href="authLink.href"
              :class="authLink.class"
              class="block w-full text-center px-4 py-3 rounded-md transition-all duration-300 transform hover:scale-105"
            >
              {{ authLink.label }}
            </Link>
          </div>
        </template>
        <template v-else>
          <div class="relative dropdown-container">
            <div
              @click.stop="toggleDropdown"
              class="bg-white/10 rounded-lg p-4 mb-4 cursor-pointer"
            >
              <div class="flex justify-between items-center space-x-3 mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-user text-3xl text-yellow-400"></i>
                    <span class="font-medium text-white">{{ $page.props.auth.user.name }}</span>
                </div>
                <i
                  class="fa-solid fa-caret-down ml-2 transition-transform duration-300 ml-auto"
                  :class="{ 'rotate-180': isDropdownOpen }"
                ></i>
              </div>

              <transition
                enter-active-class="transition ease-out duration-300"
                enter-from-class="opacity-0 scale-95"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition ease-in duration-200"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-95"
              >
                <div
                  v-if="isDropdownOpen"
                  class="space-y-2"
                  @click.stop
                >
                  <Link
                    v-for="dropdownItem in userDropdownItems"
                    :key="dropdownItem.href"
                    :href="dropdownItem.href"
                    @click="dropdownItem.action"
                    class="flex items-center px-4 py-2 text-white hover:bg-blue-800 rounded-md transition-all duration-300"
                  >
                    <i :class="dropdownItem.icon" class="mr-3 text-xl"></i>
                    {{ dropdownItem.label }}
                  </Link>
                </div>
              </transition>
            </div>
          </div>
        </template>

        <!-- Mobile Navigation Links -->
        <div class="space-y-4 mb-6">
          <a
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="flex items-center space-x-3 text-white hover:text-yellow-400 transition-colors duration-300"
          >
            <i :class="link.icon" class="text-2xl"></i>
            <span>{{ link.label }}</span>
          </a>
        </div>
      </div>
    </transition>
  </nav>
</template>
