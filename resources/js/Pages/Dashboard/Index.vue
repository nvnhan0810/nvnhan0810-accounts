<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{
    newClient?: Client,
    clients: Client[],
}>();

let showCreated = ref(props.newClient ? true : false);

onMounted(() => {
    setTimeout(() => {
        showCreated.value = false;
    }, 5000);

    return { route };
});
</script>

<template>
    <div class="container mx-auto">
        <div class="my-4">
            <h1 class="font-bold text-2xl text-center">Clients</h1>
        </div>
        <hr />

        <div class="my-4"></div>

        <div v-if="newClient && showCreated" class="bg-green-700 text-white font-semibold rounded px-4 py-3">
            <p class="mb-2">
                New Client Created <br/>
            </p>
            <p class="bg-emerald-700 px-2 py-1 rounded font-normal">
                Name: {{  newClient.name  }} <br/>
                Client ID: {{  newClient.id }} <br/>
                Secret: {{  newClient.secret }} <br/>
                Redirect: {{  newClient.redirect }}
            </p>
        </div>
        <div class="py-2">
            <Link :href="route('clients.create')" class="text-blue-500">Create</Link>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-black text-white font-bold">
                    <th class="px-2 py-1 border border-white border-b-black border-l-black">ID</th>
                    <th class="px-2 py-1 border border-white border-b-black">Name</th>
                    <th class="px-2 py-1 border border-white border-b-black border-r-black">Redirect</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="client in clients">
                    <td class="px-2 py-1 border border-black">{{  client.id  }}</td>
                    <td class="px-2 py-1 border border-black">{{  client.name  }}</td>
                    <td class="px-2 py-1 border border-black">{{  client.redirect  }}</td>
                    <!-- <td class="px-2 py-1">
                        <span>Edit</span>
                        <span class="px-2"></span>
                        <span>Delete</span>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>
