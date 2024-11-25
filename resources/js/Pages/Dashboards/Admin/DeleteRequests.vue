<script setup lang="ts">
import {Head, useForm, Link} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import {DeleteRequestInterface} from "@/Types/adminDashUsersInterface";
import approveDelete from '@/Images/x-button.png';
import AdminDashboardHeader from "@/Layouts/AdminDashboardHeader.vue";

defineProps<{
    deleteRequests: DeleteRequestInterface[],
}>();

const form = useForm({
    postId: '',
});

const getPostId = (id: string) => {
    form.postId = id;

    submit();
};


const submit = () => {
    form.post(route('admin.dashboard.delete.request'));
}
</script>

<template>
    <Head title="Admin Delete-Requests"/>
    <div class="min-h-full">
        <AdminDashboardNav/>
        <AdminDashboardHeader/>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <ul v-if="deleteRequests.length != 0" role="list">
                    <li v-for="req in deleteRequests" :key="req.post_id"
                        class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <Link :href="route('post.show',{id: req.post_id})"
                                      class="mt-1 truncate text-xs/5 text-white duration-300 transition hover:text-blue-500">
                                    {{ req.originalTitle }}
                                </Link>
                                <p class="mt-1 truncate text-xs/5 text-white">{{ req.originalDescription }}</p>
                            </div>
                        </div>
                        <div>
                            <form @submit.prevent="getPostId(req.post_id)">
                                <button><img :src="approveDelete" class="w-7 cursor-pointer" alt="delete"/></button>
                            </form>
                        </div>
                    </li>
                </ul>
                <div v-else>
                    <h1 class="text-3xl font-bold tracking-tight text-white">All Clear, no Delete requests</h1>
                </div>
            </div>
        </main>
    </div>
</template>
