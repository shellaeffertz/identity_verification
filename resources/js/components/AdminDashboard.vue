<script setup>

import { ref } from 'vue';
import ShowUser from './ShowUser.vue';
import { useForm } from '@inertiajs/vue3';
import ConfirmationModal from './ConfirmationModal.vue';

defineProps({
    users: {
        type: Object,
        required: true
    }
});

const form = useForm({
  id: null,
});

let newUser = ref(null);
let showUserModal = ref(false);
let showDeleteUserModal = ref(false);

const show = (user) => {
    newUser.value = user;
    showUserModal.value = true;
}

const deleteUser = (user) => {
    newUser.value = user;
    showDeleteUserModal.value = true;
}

const submitDeleteUser = () => {
    form.id = newUser.value.id;
    form.delete('/delete');
}

</script>

<template>

    <div class="max-w-7xl px-6 mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">

        <div
            v-for="user in users.data"
            :key="user.id"
            class="bg-white shadow-md rounded-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-xl"
        >
            <img
                :src="user.selfie ? `http://localhost:8000/storage/${user.selfie.image}` : 'http://localhost:8000/images/unknown_user.png'"
                :alt="`${user.name}'s avatar`"
                class="w-full h-48 object-contain object-center"
            />
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800 truncate flex items-center gap-2">
                    <span>{{ user.name }}</span>
                    <span v-if="user.country && user.id_front_side && user.id_back_side && user.selfie" class="text-xs text-green-500">(Completed)</span>
                    <span v-else class="text-xs text-red-500">(Incomplete)</span>
                </h3>
                <p class="text-xs text-gray-500 mt-1">{{ user.uuid }}</p>
            </div>

            <div class="flex items-center justify-center gap-4 p-4">
                <button @click="show(user)" class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" type="button">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button @click="deleteUser(user)" class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" type="button">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>

    </div>

    <ShowUser :user="newUser" :show="showUserModal" @close="showUserModal = false" />

    <ConfirmationModal :show="showDeleteUserModal" @close="showDeleteUserModal = false">

        <template #title>
            Delete User
        </template>

        <template #content>
            <p class="text-base font-bold">
                Are you sure you want to delete this user?
            </p>
        </template>

        <template #footer>
            <div class="flex flex-row justify-end gap-2 bg-gray-100 text-right">
                <button class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" @click="showDeleteUserModal = false" type="button">cancel</button>
                <button class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" @click="submitDeleteUser" type="submit">Delete</button>
            </div>
        </template>

    </ConfirmationModal>

</template>
