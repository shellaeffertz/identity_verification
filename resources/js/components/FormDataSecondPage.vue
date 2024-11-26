<script setup>

import { Link } from '@inertiajs/vue3';
import TextInput from './TextInput.vue';
import InputLabel from './InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from './InputError.vue';
import SelectCountry from './SelectCountry.vue';

const props = defineProps({
    countries: {
        type: Object,
        required: true
    },
    uuid: {
        type: String,
        required: true
    }
});

const form = useForm({
    phone: '',
    address: '',
    country: '',
    city: '',
    code: '',
    birthday: '',
    birth_place: ''
});

const submitData = () => {
    form.post(`/seconde/${props.uuid}`);
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
                        <InputLabel for="address">Address</InputLabel>
                        <TextInput
                            class="w-full"
                            id="address"
                            v-model="form.address"
                            placeholder="Enter your street address"
                        />
                        <InputError :message="form.errors.address" />
                    </div>

                    <div>
                        <InputLabel>Country</InputLabel>
                        <SelectCountry @selected="(country) => form.country = country.name" :countries="countries" />
                    </div>

                    <div>
                        <InputLabel for="city">City</InputLabel>
                        <TextInput
                            class="w-full"
                            id="city"
                            v-model="form.city"
                            placeholder="Enter your city"
                        />
                        <InputError :message="form.errors.city" />
                    </div>

                    <div>
                        <InputLabel for="code">ZIP Code</InputLabel>
                        <TextInput
                            class="w-full"
                            id="code"
                            v-model="form.code"
                            placeholder="Enter your ZIP code"
                        />
                        <InputError :message="form.errors.code" />
                    </div>

                    <div>
                        <InputLabel for="phone">Phone Number</InputLabel>
                        <TextInput
                            class="w-full"
                            id="phone"
                            v-model="form.phone"
                            placeholder="Enter phone number"
                        />
                        <InputError :message="form.errors.phone" />
                    </div>

                    <div>
                        <InputLabel for="birthday">Birthday</InputLabel>
                        <TextInput
                            type="date"
                            class="w-full"
                            id="birthday"
                            v-model="form.birthday"
                        />
                        <InputError :message="form.errors.birthday" />
                    </div>

                    <div>
                        <InputLabel for="birth_place">Birth Place</InputLabel>
                        <TextInput
                            class="w-full"
                            id="birth_place"
                            v-model="form.birth_place"
                            placeholder="Enter your place of birth"
                        />
                        <InputError :message="form.errors.birth_place" />
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
