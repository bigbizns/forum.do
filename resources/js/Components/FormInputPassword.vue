<script setup lang="ts">
import {computed, ref} from "vue";
import openEye from '@/images/open-eye.png';
import closeEye from '@/images/close-eye.png';

defineProps<{
    modelValue: string | null,
    label: string,
    labelName: string,
    error: string,
}>()
const emit = defineEmits(['update:modelValue']);
const passwordToText = ref<boolean>(false);

const togglePasswordToText = () => {
    passwordToText.value = !passwordToText.value;
};

const passwordEyeIcon = computed(() => {
    return passwordToText.value ? closeEye : openEye;
});

</script>

<template>
    <div class="mb-4">
        <label :for="label" class="block text-gray-700 text-sm font-medium mb-1">{{ labelName }}</label>
        <div
            class="flex items-center border border-gray-300 rounded-lg"
            :class="{'border-red-600':error}"
        >
            <input
                :id="label"
                :value="modelValue"
                @input="emit('update:modelValue', $event.target.value)"
                class="w-full px-4 py-2 rounded-l-lg"
                :type="passwordToText ? 'text': 'password'"
            />
            <img :src="passwordEyeIcon" alt="" class="w-4 mx-4 cursor-pointer" @click="togglePasswordToText">
        </div>
        <small class="text-red-600 font-semibold">{{ error }}</small>
    </div>
</template>
