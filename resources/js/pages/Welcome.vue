<script setup>

import { Link } from '@inertiajs/vue3';

</script>

<template>

    <nav class="bg-gray-100 shadow-md flex justify-end">
        <div class="max-w-md mx-auto px-6 py-4 flex items-center gap-4">
            <Link class="hover:underline hover:text-gray-500" href="/login">Login</Link>
            <Link class="hover:underline hover:text-gray-500" href="/first">Register</Link>
        </div>
    </nav>

</template>
