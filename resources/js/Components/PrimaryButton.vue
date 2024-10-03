<script setup lang="ts">
defineProps<{
    type: string
    text: string
}>();
</script>

<template>
    <button
        :type="type"
        class="bg-blue-500 text-white font-semibold py-2 px-8 rounded-lg hover:bg-blue-600 transition duration-300">
        {{ text }}
    </button>
</template>
