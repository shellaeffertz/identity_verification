<script setup>

import { ref } from 'vue';

const isModalVisible = ref(true);
const modalRef = ref(null);

const closeModal = () => {
  isModalVisible.value = false;
};

const handleOverlayClick = (event) => {
  if (event.target === modalRef.value) {
    event.preventDefault();
    event.stopPropagation();
  }
};

</script>

<template>

  <transition
    enter-active-class="transition duration-500 ease-in-out"
    enter-from-class="translate-y-full opacity-0"
    enter-to-class="translate-y-0 opacity-100"
    leave-active-class="transition duration-500 ease-in-out"
    leave-from-class="translate-y-0 opacity-100"
    leave-to-class="translate-y-full opacity-0"
  >
    <div
      v-if="isModalVisible"
      ref="modalRef"
      class="fixed inset-0 z-50 p-4"
      @click="handleOverlayClick"
    >
      <div
        class="absolute bottom-1 left-1/2 -translate-x-1/2 bg-white w-full max-w-md rounded-2xl shadow-2xl transform transition-all duration-300 ease-in-out"
      >
        <div class="relative p-6">

          <h2 class="text-xl font-bold text-gray-800 mb-4 flex flex-col items-center gap-3">
            <i class="fa-solid fa-circle-info text-4xl text-blue-500"></i>
            <span>ID Verification Instructions</span>
          </h2>

          <div class="w-[300px] h-[200px] mx-auto">
            <img class="w-full h-full object-cover rounded-lg" src="https://www.aitradenow.com/images/front.png" alt="identity card front side">
          </div>

          <div class="space-y-4 text-gray-600">

            <div class="flex items-center gap-2">
              <i class="fas fa-check text-green-500"></i>
              <p>Ensure you are in a well-lit area with a plain background.</p>
            </div>

            <div class="flex items-center gap-2">
              <i class="fas fa-check text-green-500"></i>
              <p>Keep the front side of your ID card steady and fully visible within the frame.</p>
            </div>

            <div class="flex items-center gap-2">
              <i class="fas fa-check text-green-500"></i>
              <p>Make sure all details are clearly visible.</p>
            </div>

            <div class="flex items-center gap-2">
              <i class="fas fa-check text-green-500"></i>
              <p>Avoid glare or shadows on the ID card.</p>
            </div>

          </div>

          <div class="mt-6">
            <button
              @click="closeModal"
              class="w-full bg-gray-900 text-white py-3 rounded-lg hover:bg-gray-800 transition duration-300 flex items-center justify-center space-x-2"
            >
              <span>I Understand</span>
            </button>
          </div>

        </div>
      </div>
    </div>
  </transition>

</template>
