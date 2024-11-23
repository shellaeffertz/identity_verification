<script setup>

import IDFrontSide from '../components/IDFrontSide.vue';

defineProps({
    uuid: {
        type: String,
        required: true
    }
});

</script>

<template>

    <IDFrontSide :uuid="uuid" />

</template>
