<script setup>

import { useForm } from '@inertiajs/vue3';
import AdminDashboard from '../components/AdminDashboard.vue';

defineProps({
    users: {
        type: Object,
        required: true
    }
});

const form = useForm({});

const logout = () => {
    form.delete('/logout');
}

</script>

<template>

    <div class="max-w-7xl px-6 mx-auto py-4 flex justify-end">
        <button @click="logout" class="px-3 py-2 border border-blue-900 rounded-md text-blue-900 text-xs hover:bg-blue-900 hover:text-white" type="button">Logout</button>
    </div>

    <AdminDashboard :users="users" />

</template>
