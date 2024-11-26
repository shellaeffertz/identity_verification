<script setup>

import Background from '../components/Background.vue';
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

    <Background />

    <FormDataSecondPage :countries="countries" :uuid="uuid" />

</template>
