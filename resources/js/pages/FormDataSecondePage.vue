<script setup>

import FormDataSecondPage from '../components/FormDataSecondPage.vue';

defineProps({
    countries: {
        type: Object,
        required: true
    },
    uuid: {
        type: String,
        required: true
    }
});

</script>

<template>

    <FormDataSecondPage :countries="countries" :uuid="uuid" />

</template>
