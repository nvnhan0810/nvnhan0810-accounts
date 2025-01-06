<script setup lang="ts">
defineProps<{
  show: boolean
}>()
</script>

<template>
  <!-- Render inside our `<div id="modals"></div>` in index.html -->
  <Teleport to="#modals">
    <!-- Show / hide the modal -->
    <div v-if="show" class="">
      <!-- The backdrop -->
      <div class="fixed inset-0 bg-gray-900 opacity-40"></div>

      <!-- Where the actual content goes -->
      <div class="fixed inset-0 flex items-center justify-center shadow-md">
        <div class="bg-white text-black rounded">
          <slot></slot>
        </div>
      </div>
    </div>
  </Teleport>
</template>
