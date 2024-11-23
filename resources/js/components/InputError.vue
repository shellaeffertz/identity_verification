<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="mt-1 text-xs text-red-600">
            {{ message }}
        </p>
    </div>
</template>
