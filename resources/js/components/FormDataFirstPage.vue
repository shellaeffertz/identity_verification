<script setup>

import { Link } from '@inertiajs/vue3';
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
    form.post('/first');
};

</script>

<template>

    <div class="min-h-screen flex items-center justify-center p-6">

        <div class="bg-white shadow-2xl rounded-xl overflow-hidden w-full md:w-[30%] xlg:w-1/4 max-w-4xl">

            <div class="p-8 bg-gray-200 border-b border-b-blue-900">
                <div class="flex items-center w-fit mx-auto mb-8">
                    <Link
                        href="/"
                        class="flex items-center transform hover:scale-105 transition-transform duration-300 group"
                    >
                        <i class="fa-brands fa-bitcoin text-6xl text-yellow-400 group-hover:rotate-[360deg] transition-transform duration-700"></i>
                        <span class="ml-3 text-3xl font-bold text-blue-900 transition-colors duration-300">TradeNow</span>
                    </Link>
                </div>
                <p class="text-center text-blue-900 mt-2 font-bold">
                    Please provide the requested information to create an account
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

                        <div>
                            <Link class="text-sm text-gray-500 hover:underline" href="/login">Already Have An Account ?</Link>
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
