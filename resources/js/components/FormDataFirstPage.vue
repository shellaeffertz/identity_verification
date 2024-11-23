<script setup>

import TextInput from './TextInput.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from './InputError.vue';

const form = useForm({
    firstname: '',
    lastname: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const submitData = () => {
    form.post('/');
};

</script>

<template>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-6">

        <div class="bg-white shadow-2xl rounded-xl overflow-hidden w-full max-w-4xl">

            <div class="p-8 bg-gray-50 border-b border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 text-center">
                    Personal Verification
                </h2>
                <p class="text-center text-gray-600 mt-2">
                    Please provide your personal details for verification
                </p>
            </div>

            <form @submit.prevent="submitData" class="p-8">

                    <div class="space-y-6">

                        <div>
                            <InputLabel for="firstname">First Name</InputLabel>
                            <TextInput
                                class="w-full"
                                id="firstname"
                                v-model="form.firstname"
                                placeholder="Enter your first name"
                            />
                            <InputError :message="form.errors.firstname" />
                        </div>

                        <div>
                            <InputLabel for="lastname">Last Name</InputLabel>
                            <TextInput
                                class="w-full"
                                id="lastname"
                                v-model="form.lastname"
                                placeholder="Enter your last name"
                            />
                            <InputError :message="form.errors.lastname" />
                        </div>

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

                        <div>
                            <InputLabel for="password_confirmation">Confirm Password</InputLabel>
                            <TextInput
                                type="password"
                                class="w-full"
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                placeholder="Confirm your password"
                                autocomplete="off"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>

                    </div>

                <div class="mt-8 flex justify-end">
                    <button
                        class="px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                        type="submit"
                    >
                        Continue
                    </button>
                </div>

            </form>

        </div>

    </div>

</template>
