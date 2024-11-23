<script setup>

import IDBackSide from '../components/IDBackSide.vue';

defineProps({
    uuid: {
        type: String,
        required: true
    }
});

</script>

<template>

    <IDBackSide :uuid="uuid" />

</template>
