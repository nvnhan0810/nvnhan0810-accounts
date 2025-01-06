<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

async function submit() {
    router.post(route('admin.login.submit'));
}
</script>

<template>
    <form @submit.prevent="submit">
        <button type="submit">Login</button>
    </form>
</template>
