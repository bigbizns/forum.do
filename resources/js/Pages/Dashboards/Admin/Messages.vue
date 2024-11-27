<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import {MessagesInterface} from "@/Types/adminDashUsersInterface";
import {ref} from "vue";
import MessageAnswerModal from "@/Pages/Dashboards/Admin/Modals/MessageAnswerModal.vue";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";

defineProps<{
    messages: MessagesInterface[]
}>();

const isAnswering = ref<boolean>(false);
const messageInfo = ref<MessagesInterface>({
    id: '',
    user_id: '',
    email: '',
    topic: '',
    message: '',
});

const toggleModal = (message?: MessagesInterface) => {
    if (message) {
        messageInfo.value = message;
    }
    isAnswering.value = !isAnswering.value;
};
</script>

<template>
    <Head title="Admin Edit-Requests"/>
    <div class="min-h-full">
        <AdminDashboardNav/>
        <DashboardHeader/>
        <template v-if="isAnswering">
            <MessageAnswerModal @cancel="toggleModal" :message="messageInfo"/>
        </template>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <ul v-if="messages.length != 0" role="list">
                    <li v-for="message in messages" :key="message.id"
                        class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="mt-1 truncate text-xl text-white">{{ message.topic }}</p>
                                <p class="mt-1 truncate text-m text-white">{{ message.message }}</p>
                                <div class="flex gap-2">
                                    <button
                                        @click="toggleModal(message)"
                                        class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                        Answer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-else>
                    <h1 class="text-3xl font-bold tracking-tight text-white">All Clear, no Messages</h1>
                </div>
            </div>
        </main>
    </div>
</template>
