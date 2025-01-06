<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const formData = useForm({
    name: null,
    redirect: null,
})

async function submitForm() {
    await formData.post(route('clients.store'));
}
</script>

<template>
    <div class="container mx-auto">
        <div class="my-4">
            <h1 class="font-bold text-2xl text-center">New Client</h1>
        </div>
        <hr />
        <div class="my-2"></div>
        <form class="max-w-sm mx-auto" @submit.prevent="submitForm">
            <div class="mb-2">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                <input id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" v-model="formData.name" />
                <p class="mt-2 text-sm text-red-600" v-if="formData.errors.name">{{ formData.errors.name }}</p>
            </div>
            <div class="mb-2">
                <label for="redirect" class="block mb-2 text-sm font-medium text-gray-900">Redirect URL</label>
                <input id="redirect" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" v-model="formData.redirect" />
                <p class="mt-2 text-sm text-red-600" v-if="formData.errors.redirect">{{ formData.errors.redirect }}</p>
            </div>

            <div class="text-center">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" :disabled="formData.processing">Create</button>
            </div>
        </form>
    </div>
</template>
