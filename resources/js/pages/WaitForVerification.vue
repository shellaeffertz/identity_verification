<script setup>

import { onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    uuid: {
        type: String,
        required: true
    }
});

const form = useForm({});

const logout = () => {
    form.delete('/logout');
}

onMounted(() => {
    const progress = document.querySelector('.progress-bar');
    if (progress) {
        progress.style.width = '100%';
    }
});

</script>

<template>

    <div class="relative min-h-screen bg-gray-50 flex items-center justify-center px-4">

        <button
            @click="logout"
            class="absolute top-10 right-10 text-xs sm:text-sm text-blue-900 hover:underline"
            type="button"
        >
            Logout
        </button>

        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">

            <div class="text-center">
                <div class="mx-auto bg-green-100 rounded-full h-16 w-16 flex items-center justify-center">
                    <svg class="h-8 w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Registration Successful!</h2>
                <p class="mt-2 text-sm text-gray-600">Hello, {{ user.name }}</p>
                <p class="mt-4 text-gray-600">Your application is being reviewed by our team.</p>
            </div>

            <div class="mt-8">
                <div class="relative pt-1">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                        <div class="progress-bar transition-all duration-[20000ms] ease-out w-0 h-full bg-blue-500"></div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Application submitted successfully</span>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="h-5 w-5 text-blue-500 mr-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Verification in progress</span>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-sm text-gray-500">Reference Number</p>
                <p class="text-sm font-mono text-gray-900">{{ uuid }}</p>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    We'll notify you once the verification is complete.
                    <br>This usually takes 24-48 hours.
                </p>
            </div>

        </div>

    </div>

</template>

<style scoped>
.progress-bar {
    transition: width 20s ease-out;
}
</style>
