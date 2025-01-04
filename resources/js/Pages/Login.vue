<script setup>
import { router } from '@inertiajs/vue3';
import { inject } from 'vue';

const route = inject('route');

async function submit() {
    await router.post(route('admin.login.submit'));
}
</script>

<template>
    <form @submit.prevent="submit">
        <button type="submit">Login</button>
    </form>
</template>
