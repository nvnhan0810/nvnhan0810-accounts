<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { route } from 'ziggy-js';
import BaseModal from '../../Components/modals/BaseModal.vue';

const props = defineProps<{
    newClient?: Client,
    clients: Client[],
    editClient?: string,
    deletedClient?: string,
}>();

let showFlash = ref(props.newClient || props.editClient || props.deletedClient ? true : false);
let showDeleteModal = ref(false);
let deletedId = ref<string | null>(null);

onMounted(() => {
    if (showFlash.value = true) {
        setTimeout(() => {
            showFlash.value = false;
        }, 5000);
    }

    return { route };
});

const onClickDelete = (clientId: string) => {
    deletedId.value = clientId;
    showDeleteModal.value = true;
}

const hideDeleteModal = () => {
    deletedId.value = null;
    showDeleteModal.value = false;
}

const deleteClientHandler = async () => {
    if (deletedId.value == null) {
        return;
    }

    await router.delete(route('clients.delete', { id: deletedId.value }), {
        onSuccess: () => {
            hideDeleteModal();
        }
    });
}
</script>

<template>
    <div class="container mx-auto">
        <div class="my-4">
            <h1 class="font-bold text-2xl text-center">Clients</h1>
        </div>
        <hr />

        <div class="my-4"></div>

        <div v-if="newClient && showFlash" class="bg-green-700 text-white font-semibold rounded px-4 py-3">
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

        <div v-if="editClient && showFlash" class="bg-green-700 text-white font-semibold rounded px-4 py-3">
            Client {{ editClient }} edited success!
        </div>

        <div v-if="deletedClient && showFlash" class="bg-red-700 text-white font-semibold rounded px-4 py-3">
            Client {{ deletedClient }} deleted success!
        </div>

        <div class="py-2">
            <Link :href="route('clients.create')" class="text-blue-500">Create</Link>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-black text-white font-bold">
                    <th class="px-2 py-1 border border-white border-b-black border-l-black">ID</th>
                    <th class="px-2 py-1 border border-white border-b-black">Name</th>
                    <th class="px-2 py-1 border border-white border-b-blac">Redirect</th>
                    <th class="px-2 py-1 border border-white border-b-black border-r-black"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="client in clients">
                    <td class="px-2 py-1 border border-black">{{  client.id  }}</td>
                    <td class="px-2 py-1 border border-black">{{  client.name  }}</td>
                    <td class="px-2 py-1 border border-black">{{  client.redirect  }}</td>
                    <td class="px-2 py-1 border border-black">
                        <Link :href="route('clients.edit', { id: client.id })" class="text-blue-500">Edit</Link>
                        <span class="block mx-1"></span>
                        <button id="deleteButton" @click="onClickDelete(client.id)" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="block btn-link text-red-600" type="button">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

   <BaseModal :show="showDeleteModal">
    <div class="p-4">
      <h6 class="text-lg font-bold">Delete Client</h6>

      <div class="py-2">Do you really want to delete client?</div>

      <div class="flex items-center justify-end gap-3">
        <button
            type="button"
            class="bg-indigo-200 px-3 py-1 font-medium"
            @click="hideDeleteModal"
        >
            Cancel
        </button>
        <button
            type="button"
            class="bg-red-300 px-3 py-1 font-medium text-white"
            @click="deleteClientHandler"
        >
            Delete
        </button>
      </div>
    </div>
   </BaseModal>
</template>
