<script setup>

import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';

const emit = defineEmits(['close']);

let props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    user: {
        required: true
    }
});

const close = () => {
    emit('close');
};

</script>

<template>

    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <form>

            <div class="px-6 py-4 space-y-4">

                <h3 class="text-lg font-medium text-gray-900">
                    User Information
                </h3>

                <div>
                    <InputLabel>Full Name :</InputLabel>
                    <TextInput class="w-full" :value="user.name" disabled />
                </div>

                <div>
                    <InputLabel>User Uuid :</InputLabel>
                    <TextInput class="w-full" :value="user.uuid" disabled />
                </div>

                <div>
                    <InputLabel>First Name :</InputLabel>
                    <TextInput class="w-full" :value="user.firstname" disabled />
                </div>

                <div>
                    <InputLabel>Last Name :</InputLabel>
                    <TextInput class="w-full" :value="user.lastname" disabled />
                </div>

                <div>
                    <InputLabel>Email :</InputLabel>
                    <TextInput class="w-full" :value="user.email" disabled />
                </div>

                <div v-if="user.country" class="space-y-4">
                    <div>
                        <InputLabel>Address :</InputLabel>
                        <TextInput class="w-full" :value="user.address" disabled />
                    </div>

                    <div>
                        <InputLabel>Country :</InputLabel>
                        <TextInput class="w-full" :value="user.country" disabled />
                    </div>

                    <div>
                        <InputLabel>City :</InputLabel>
                        <TextInput class="w-full" :value="user.city" disabled />
                    </div>

                    <div>
                        <InputLabel>Phone :</InputLabel>
                        <TextInput class="w-full" :value="user.phone" disabled />
                    </div>

                    <div>
                        <InputLabel>Birthday :</InputLabel>
                        <TextInput class="w-full" :value="user.birthday" disabled />
                    </div>

                    <div>
                        <InputLabel>Birth Place :</InputLabel>
                        <TextInput class="w-full" :value="user.birth_place" disabled />
                    </div>
                </div>

                <div v-else>
                    <div>
                        <InputLabel>The step 2 is not completed :</InputLabel>
                        <TextInput class="w-full text-sm" :value="`http://localhost:8000/seconde/${user.uuid}`" disabled />
                    </div>
                </div>

                <div v-if="user.country && user.id_front_side" class="space-y-4 bg-gray-100 rounded-md px-4 p-2">
                    <h3 class="text-center font-bold text-gray-500">ID Front Side</h3>
                    <div>
                        <InputLabel>Image :</InputLabel>
                        <div>
                            <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.id_front_side.image}`" target="_blank">
                                See Image
                            </a>
                        </div>
                    </div>
                    <div>
                        <div>
                            <InputLabel>Video :</InputLabel>
                            <div>
                                <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.id_front_side.video}`" target="_blank">
                                    See Video
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else-if="user.country && !user.id_front_side">
                    <div>
                        <InputLabel for="birth_place">The ID's front side is not registered</InputLabel>
                        <TextInput class="w-full text-sm" id="birth_place" :value="`http://localhost:8000/id-front-side/${user.uuid}`" disabled />
                    </div>
                </div>

                <div v-if="user.country && user.id_front_side && user.id_back_side" class="space-y-4 bg-gray-100 rounded-md px-4 p-2">
                    <h3 class="text-center font-bold text-gray-500">ID Back Side</h3>
                    <div>
                        <InputLabel>Image :</InputLabel>
                        <div>
                            <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.id_back_side.image}`" target="_blank">
                                See Image
                            </a>
                        </div>
                    </div>
                    <div>
                        <div>
                            <InputLabel>Video :</InputLabel>
                            <div>
                                <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.id_back_side.video}`" target="_blank">
                                    See Video
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else-if="user.country && user.id_front_side && !user.id_back_side">
                    <div>
                        <InputLabel>The ID's front side is not registered</InputLabel>
                        <TextInput class="w-full text-sm" :value="`http://localhost:8000/id-back-side/${user.uuid}`" disabled />
                    </div>
                </div>

                <div v-if="user.country && user.id_front_side && user.id_back_side && user.selfie" class="space-y-4 bg-gray-100 rounded-md px-4 p-2">
                    <h3 class="text-center font-bold text-gray-500">Selfie</h3>
                    <div>
                        <InputLabel>Image :</InputLabel>
                        <div>
                            <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.selfie.image}`" target="_blank">
                                See Image
                            </a>
                        </div>
                    </div>
                    <div>
                        <div>
                            <InputLabel>Video :</InputLabel>
                            <div>
                                <a class="hover:underline text-blue-500 text-sm" :href="`http://localhost:8000/storage/${user.selfie.video}`" target="_blank">
                                    See Video
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else-if="user.country && user.id_front_side && user.id_back_side && !user.selfie">
                    <div>
                        <InputLabel>The selfie is not registered</InputLabel>
                        <TextInput class="w-full text-sm" :value="`http://localhost:8000/selfie/${user.uuid}`" disabled />
                    </div>
                </div>

            </div>

            <div class="flex flex-row justify-end gap-2 px-6 py-4 bg-gray-100 text-right">
                <button class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" @click="close()" type="button">Close</button>
            </div>
        </form>

    </Modal>

</template>
