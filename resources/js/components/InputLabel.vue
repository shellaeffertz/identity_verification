<script setup>

defineProps({
    value: String,
});

</script>

<template>

    <label class="block text-sm font-bold text-blue-900 mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>

</template>
