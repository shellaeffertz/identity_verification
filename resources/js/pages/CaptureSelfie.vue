<script setup>

import Selfie from '../components/Selfie.vue';

defineProps({
    uuid: {
        type: String,
        required: true
    }
});

</script>

<template>

    <Selfie :uuid="uuid" />

</template>
