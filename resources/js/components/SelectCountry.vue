<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    countries: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['selected']);

const country = ref('');
const isDropdownOpen = ref(false);

const filteredCountries = computed(() => {
    if (!country.value) return props.countries;

    return props.countries.filter(c =>
        c.name.toLowerCase().includes(country.value.toLowerCase())
    );
});

const selectCountry = (selectedCountry) => {
    country.value = selectedCountry.name;
    isDropdownOpen.value = false;
    emit('selected', selectedCountry);
};

const handleInput = () => {
    isDropdownOpen.value = true;
};

const handleBlur = () => {
    setTimeout(() => {
        isDropdownOpen.value = false;
    }, 200);
};
</script>

<template>

    <div class="relative w-full">

        <input
            v-model="country"
            type="text"
            placeholder="Select a country"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            @input="handleInput"
            @blur="handleBlur"
        />

        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <ul
                v-if="isDropdownOpen && filteredCountries.length"
                class="absolute z-10 left-0 top-[calc(100%+5px)] w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto"
            >
                <li
                    v-for="country in filteredCountries"
                    :key="country.name"
                    @mousedown.prevent="selectCountry(country)"
                    class="flex items-center gap-3 p-2 hover:bg-gray-100 cursor-pointer transition duration-200"
                >
                    <img
                        class="w-8 h-6 object-cover rounded"
                        :src="country.image"
                        :alt="`${country.name} flag`"
                    />
                    <span class="text-sm text-gray-800">{{ country.name }}</span>
                </li>
            </ul>

        </transition>

    </div>

</template>

<style scoped>
/* Custom scrollbar for the dropdown */
ul::-webkit-scrollbar {
    width: 6px;
}

ul::-webkit-scrollbar-track {
    background: #f1f1f1;
}

ul::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

ul::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
