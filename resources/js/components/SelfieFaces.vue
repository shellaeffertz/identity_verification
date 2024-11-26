<script setup>

import { ref, onMounted, computed } from 'vue'

const currentStep = ref(0);
const isAnimating = ref(false);
const arrowOpacity = ref(0);
const arrowDirection = ref('none');

const steps = [
  { name: 'direct', delay: 2000, arrow: 'none' },
  { name: 'left-50', delay: 800, arrow: 'left' },
  { name: 'left-100', delay: 1500, arrow: 'left' },
  { name: 'left-50', delay: 800, arrow: 'right' },
  { name: 'direct', delay: 1500, arrow: 'right' },
  { name: 'right-50', delay: 800, arrow: 'right' },
  { name: 'right-100', delay: 1500, arrow: 'right' },
  { name: 'right-50', delay: 800, arrow: 'left' },
  { name: 'direct', delay: 2000, arrow: 'none' },
];

const imageOpacity = computed(() => (imageName) => {
  const currentImage = steps[currentStep.value]?.name;
  if (currentImage === imageName) return 1;

  const imagePositions = {
    'direct': 0,
    'left-50': -50,
    'left-100': -100,
    'right-50': 50,
    'right-100': 100
  };

  const currentPos = imagePositions[currentImage];
  const targetPos = imagePositions[imageName];

  const distance = Math.abs(currentPos - targetPos);
  if (distance <= 25) {
    return 1 - (distance / 25)
  };
  return 0;
})

const startAnimation = async () => {
  if (isAnimating.value) return;

  isAnimating.value = true;
  currentStep.value = 0;

  for (let i = 0; i < steps.length; i++) {
    currentStep.value = i;
    arrowDirection.value = steps[i].arrow;

    // Fade arrow in/out
    if (steps[i].arrow !== 'none') {
      arrowOpacity.value = 1;
    } else {
      arrowOpacity.value = 0;
    }

    await new Promise(resolve => setTimeout(resolve, steps[i].delay));
  };

  isAnimating.value = false;
}

onMounted(() => {
  startAnimation();
});
</script>

<template>

  <div class="relative">

    <div class="absolute w-28 top-40 left-1/2 -translate-x-1/2 z-50">
      <img
        v-for="(imgSrc, index) in ['left-100', 'left-50', 'direct', 'right-50', 'right-100']"
        :key="index"
        :src="`https://www.aitradenow.com/images/${imgSrc}.png`"
        :alt="`${imgSrc} face`"
        class="w-28 aspect-square absolute transition-all duration-300"
        :style="{
          opacity: imageOpacity(imgSrc)
        }"
      />
    </div>

    <div
      class="absolute z-50 w-full top-28 left-0 flex justify-center items-center transition-opacity duration-300"
      :style="{ opacity: arrowOpacity }"
    >

      <div
        v-if="arrowDirection === 'left'"
        class="flex items-center text-white animate-pulse"
      >
        <i class="fa-solid fa-arrow-left"></i>
        <span class="text-lg font-semibold ml-2">Turn Left</span>
      </div>

      <div
        v-if="arrowDirection === 'right'"
        class="flex items-center text-white animate-pulse"
      >
        <span class="text-lg font-semibold mr-2">Turn Right</span>
        <i class="fa-solid fa-arrow-right"></i>
      </div>
    </div>

  </div>

</template>

<style scoped>
.transition-all {
  transition: all 0.3s ease-in-out;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
