<script setup>

import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SelfieFaces from './SelfieFaces.vue';
import LoadingSpinner from './LoadingSpinner.vue';
import SelfieInformationModal from './SelfieInformationModal.vue';

const props = defineProps({
    uuid: {
        type: String,
        required: true
    }
});

const videoElement = ref(null);
const mediaRecorder = ref(null);
const recordedChunks = ref([]);
const isRecording = ref(false);
const isUploading = ref(false);

const form = useForm({
  image: null,
  video: null
});

const startCamera = async () => {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: 'user',
        width: { ideal: 1920 },
        height: { ideal: 1080 }
      },
      audio: true
    });

    videoElement.value.srcObject = stream;

    const options = {
      mimeType: 'video/mp4'
    };

    mediaRecorder.value = new MediaRecorder(stream, options);

    mediaRecorder.value.ondataavailable = (event) => {
      if (event.data.size > 0) {
        recordedChunks.value.push(event.data)
      }
    };

  } catch (error) {
    console.error('Camera access error:', error);
    alert('Could not access camera. Ensure permissions are granted.');
  }
}

const captureAndRecord = async () => {
  if (isRecording.value) return;
  isRecording.value = true;
  recordedChunks.value = [];

  const canvas = document.createElement('canvas');
  const video = videoElement.value;

  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  const context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, canvas.width, canvas.height);

  const imageBlob = await new Promise(resolve => {
    canvas.toBlob(resolve, 'image/jpeg')
  });

  form.image = imageBlob;

  mediaRecorder.value.start();

  setTimeout(async () => {
    mediaRecorder.value.stop();

    await new Promise(resolve => {
      mediaRecorder.value.onstop = resolve;
    });

    const videoBlob = new Blob(recordedChunks.value, { type: 'video/mp4' });
    form.video = videoBlob;

    isUploading.value = true;
    form.post(`/store-selfie/${props.uuid}`);
    isRecording.value = false;
    isUploading.value = false;
  }, 10000);
}

onMounted(startCamera);
</script>

<template>

  <div class="fixed inset-0 bg-black overflow-hidden">

    <p class="absolute top-1 left-1/2 transform -translate-x-1/2 bg-black/70 text-white px-6 py-3 rounded-md z-50 text-center w-full">
        Please take a selfie by holding your device at eye level, ensuring your face is centered within the circle
    </p>

    <SelfieFaces v-if="isRecording" />

    <video
      ref="videoElement"
      class="absolute top-0 left-0 w-full h-full object-cover"
      autoplay
      muted
    ></video>

    <div class="fixed left-0 top-0 w-full h-full z-30 grid grid-cols-[1fr_250px_1fr]">
        <div class="h-full">
            <div class="w-full h-full bg-black/60"></div>
        </div>

        <div class="h-full grid grid-rows-[1fr_250px_1fr]">
            <div class="flex-1 bg-black/60"></div>
            <div class="relative flex-1 bg-transparent overflow-hidden">
                <div class="w-full h-full rounded-full border-dashed border-4 border-white outline outline-[100px] outline-black/60"></div>
            </div>
            <div class="flex-1 bg-black/60"></div>
        </div>

        <div class="h-full">
            <div class="w-full h-full bg-black/60"></div>
        </div>
    </div>

    <button
        @click="captureAndRecord"
        :disabled="isUploading || isRecording"
        class="absolute z-50 bottom-10 left-1/2 transform -translate-x-1/2
          bg-white/70 text-black px-6 py-3 rounded-full
          disabled:opacity-50 disabled:cursor-not-allowed"
    >
      <span v-if="!isUploading && !isRecording">Take selfie</span>
      <LoadingSpinner v-if="isUploading || isRecording" />
    </button>
  </div>

  <SelfieInformationModal />

</template>
