<script setup lang="ts">
defineProps<{
    modelValue: string | null,
    label: string,
    labelName: string,
    type: string,
    error: string,
}>();
const emit = defineEmits(['update:modelValue']);

</script>

<template>
    <div class="mb-4">
        <label :for="label" class="block text-gray-700 text-sm font-medium mb-1">{{ labelName }}</label>
        <input
            :id="label"
            :type="type"
            :value="modelValue"
            @input="emit('update:modelValue', $event.target.value)"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            :class="{'border-red-600': error}"
        />
        <small class="text-red-600 font-semibold">{{ error }}</small>
    </div>
</template>
