<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>

    <input
        ref="input"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none rounded-md shadow-sm disabled:bg-gray-100 disabled:border-gray-100 placeholder:text-gray-500 placeholder:text-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />

</template>
