<script setup>

import Market from '../components/Market.vue';
import Navbar from '../components/Navbar.vue';
import HomeSection from '../components/HomeSection.vue';
import Background from '../components/Background.vue';
import FooterSection from '../components/FooterSection.vue';

</script>

<template>

    <Background />

    <Navbar />

    <HomeSection />

    <Market class="mb-16" />

    <FooterSection />

</template>

<style>

html {
    scroll-behavior: smooth;
}

/* width */
::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #1e3a8a;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #fbbf24;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #1e40af;
}

</style>
