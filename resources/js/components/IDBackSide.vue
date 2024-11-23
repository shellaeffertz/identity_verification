<script setup>

import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import LoadingSpinner from './LoadingSpinner.vue';
import BackSideIdInformationModal from './BackSideIdInformationModal.vue';

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
        facingMode: 'environment',
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
    form.post(`/store-back-side/${props.uuid}`);
    isRecording.value = false;
    isUploading.value = false;
  }, 10000);
}

onMounted(startCamera);
</script>

<template>
  <div class="fixed inset-0 bg-black overflow-hidden">
    <p class="absolute top-1 left-1/2 transform -translate-x-1/2 bg-black/70 text-white px-6 py-3 rounded-md z-50 text-center w-full">
      Please capture the back side of your ID card by holding it steady and ensuring it fits entirely within the centered frame on your screen.
    </p>

    <p v-if="isUploading || isRecording" class="absolute top-32 left-1/2 transform -translate-x-1/2 bg-black/70 text-white px-6 py-3 rounded-md z-50 text-center">
        Please Don't move
    </p>

    <video
      ref="videoElement"
      class="absolute top-0 left-0 w-full h-full object-cover"
      autoplay
      muted
    ></video>

    <div className="fixed left-0 top-0 w-full h-full z-30 grid grid-cols-[1fr_350px_1fr]">
        <div className="h-full">
            <div className="w-full h-full bg-black/60"></div>
        </div>

        <div className="h-full grid grid-rows-[1fr_200px_1fr]">
            <div className="flex-1 bg-black/60"></div>
            <div className="relative flex-1 bg-transparent">
                <div className="absolute -top-1 -left-1 w-8 h-8 border-t-4 border-l-4 border-white"></div>
                <div className="absolute -top-1 -right-1 w-8 h-8 border-t-4 border-r-4 border-white"></div>
                <div className="absolute -bottom-1 -left-1 w-8 h-8 border-b-4 border-l-4 border-white"></div>
                <div className="absolute -bottom-1 -right-1 w-8 h-8 border-b-4 border-r-4 border-white"></div>
            </div>
            <div className="flex-1 bg-black/60"></div>
        </div>

        <div className="h-full">
            <div className="w-full h-full bg-black/60"></div>
        </div>
    </div>

    <button
        @click="captureAndRecord"
        :disabled="isUploading || isRecording"
        class="absolute z-50 bottom-10 left-1/2 transform -translate-x-1/2
          bg-white/70 text-black px-6 py-3 rounded-full
          disabled:opacity-50 disabled:cursor-not-allowed"
    >
      <span v-if="!isUploading && !isRecording">Capture Back ID</span>
      <LoadingSpinner v-if="isUploading || isRecording" />
    </button>

  </div>

  <BackSideIdInformationModal />

</template>
