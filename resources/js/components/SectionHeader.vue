<script setup>

import { ref, onMounted } from 'vue';

const isVisible = ref(false);
const overviewText = ref(null);

const setupIntersectionObserver = () => {

    if (!overviewText.value) return;

    const observer = new IntersectionObserver(
        ([entry]) => {
            isVisible.value = entry.isIntersecting;
        },
        { threshold: 0.1 }
    );

    observer.observe(overviewText.value);

    return observer;
};

onMounted(() => {

    const observer = setupIntersectionObserver();

    return () => {
        if (observer) observer.disconnect();
    };
});

</script>

<template>

    <section class="text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <div class="flex justify-center items-center mb-6">
                    <div class="w-16 h-1 bg-yellow-400 mr-4"></div>
                    <h2 class="text-3xl md:text-4xl font-bold">
                        <slot name="title"></slot>
                    </h2>
                    <div class="w-16 h-1 bg-yellow-400 ml-4"></div>
                </div>
                <p
                    class="text-xl text-gray-300 leading-relaxed mb-8 animate-fade-in"
                    :class="{ 'opacity-0': !isVisible }"
                    ref="overviewText"
                >
                    <slot name="description"></slot>
                </p>
            </div>
        </div>
    </section>

</template>

<style scoped>

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeIn 1s ease-out;
}

</style>
