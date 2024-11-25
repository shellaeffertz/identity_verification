<script setup>

import TextInput from './TextInput.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from './InputError.vue';

const form = useForm({
    email: '',
    password: ''
});

const submitData = () => {
    form.post('/login');
};

</script>

<template>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-6">

        <div class="bg-white shadow-2xl rounded-xl overflow-hidden w-full md:w-1/2 xlg:w-1/4 max-w-4xl">

            <div class="p-8 bg-gray-50 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 text-center">
                    Login
                </h2>
                <p class="text-center text-gray-600 mt-2">
                    Please provide your personal credentials to access your account
                </p>
            </div>

            <form @submit.prevent="submitData" class="p-8">

                    <div class="space-y-6">

                        <div>
                            <InputLabel for="email">Email</InputLabel>
                            <TextInput
                                type="email"
                                class="w-full"
                                id="email"
                                v-model="form.email"
                                placeholder="Enter your email address"
                            />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password">Password</InputLabel>
                            <TextInput
                                type="password"
                                class="w-full"
                                id="password"
                                v-model="form.password"
                                placeholder="Enter your password"
                                autocomplete="off"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                    </div>

                <div class="mt-8 flex justify-end">
                    <button
                        class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                        type="submit"
                    >
                        Login
                    </button>
                </div>

            </form>

        </div>

    </div>

</template>
