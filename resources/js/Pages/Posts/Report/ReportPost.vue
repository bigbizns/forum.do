<script setup lang="ts">
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import {ReportTypeInterface} from "@/Types/ReportTypeInterface";

const props = defineProps<{
    isReporting: boolean,
    postId: number | string,
    reportTypes: ReportTypeInterface[],
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();
const form = useForm({
    reason: null,
    message: null
});
const cancel = () => {
    emit('cancel');
};
const submit = () => {
    form.post(route('post.report', {id: props.postId},), {onSuccess: () => emit('cancel')});
};
</script>

<template>
    <div
        class="fixed z-10 inset-0 flex items-center justify-center bg-black/60 transition-opacity duration-300 ease-out"
        @click="cancel">
        <div class="z-30 bg-gray-800 p-8 rounded-lg shadow-lg transform w-[100vh]" @click.stop>
            <form @submit.prevent="submit">
                <div class="flex justify-between items-center mb-4">
                    <div class="w-full max-w-xs">
                        <label for="category" class="block text-sm font-medium text-white mb-2">Report type</label>
                        <select v-model="form.reason" id="category" name="category"
                                class="block w-full p-2.5 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out">
                            <option v-for="report in reportTypes" :value="report.value" class="text-gray-400">
                                {{ report.name }}
                            </option>
                        </select>
                        <small class="text-red-600 font-semibold">{{ form.errors.reason }}</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-white">Reason for Report</label>
                    <textarea
                        v-model="form.message"
                        rows="5"
                        id="title"
                        class="mt-2 block w-full p-3 bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-300 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500 transition duration-300 ease-in-out"
                        placeholder="Explain why the post should be removed"
                    ></textarea>
                    <small class="text-red-600 font-semibold">{{ form.errors.message }}</small>
                </div>

                <div class="flex mt-6 gap-4">
                    <PrimaryButton text="Submit" type="submit"/>
                    <button @click="cancel"
                            class="inline-flex items-center justify-center px-6 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                        Cancel
                    </button>
                </div>
            </form>
            <small class="text-green-500 font-semibold">{{ $page.props.flash.message }}</small>
        </div>
    </div>
</template>
