<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import {EditRequestInterface, EditRequestPostInterface} from "@/Types/adminDashUsersInterface";
import {ref} from "vue";
import EditRequestModal from "@/Pages/Dashboards/Admin/Modals/EditRequestModal.vue";

defineProps<{
    editRequests: EditRequestInterface[]
}>();

const isLookingAtModal = ref<boolean>(false);
const post = ref<EditRequestPostInterface>({
    post_id: null,
    action: null,
    title: null,
    originalTitle: null,
    description: null,
    originalDescription: null,
});

const toggleModal = (req?: EditRequestPostInterface) => {
    if (req) {
        post.value = req;
    }

    isLookingAtModal.value = !isLookingAtModal.value;
};
</script>

<template>
    <Head title="Admin Edit-Requests"/>
    <template v-if="isLookingAtModal">
        <EditRequestModal @cancel="toggleModal" :post="post"/>
    </template>
    <div class="min-h-full">
        <AdminDashboardNav/>
        <header class="bg-black/40 shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex gap-2 items-center">
                <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
                <h1 class="text-3xl font-semibold text-green-500">{{ $page.props.flash.message }}</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <ul v-if="editRequests.length != 0" role="list">
                    <li v-for="req in editRequests" :key="req.post_id" @click="toggleModal(req)"
                        class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded cursor-pointer">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="mt-1 truncate text-xs/5 text-white">{{ req.originalTitle }}</p>
                                <p class="mt-1 truncate text-xs/5 text-white">{{ req.originalDescription }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-else>
                    <h1 class="text-3xl font-bold tracking-tight text-white">All Clear, no edit requests</h1>
                </div>
            </div>
        </main>
    </div>
</template>
