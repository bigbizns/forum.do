<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import {ReportsInterface} from "@/Types/adminDashUsersInterface";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";

defineProps<{
    reports: ReportsInterface[]
}>();

const form = useForm({
    postId: ''
});

const getPostId = (postId: string) => {
    form.postId = postId;

    submit();
};

const submit = () => {
    form.post(route('admin.dashboard.delete.reported.post'));
};
</script>

<template>
    <Head title="Admin Reports"/>
    <div class="min-h-full">
        <AdminDashboardNav/>
        <DashboardHeader/>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <ul v-if="reports.length != 0" role="list">
                    <li v-for="rep in reports" :key="rep.id"
                        class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded">
                        <div class="flex min-w-0 gap-x-4">
                            <!--TODO: Add User who reported this in case he trolling with reports-->
                            <div class="min-w-0 flex-auto">
                                <p class="mt-1 truncate text-xl text-white">{{ rep.reason }}</p>
                                <p class="mt-1 truncate text-m text-white">{{ rep.message }}</p>
                                <div class="flex gap-2">
                                    <Link :href="route('post.show',{id: rep.post_id})"
                                          class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                        Check Post
                                    </Link>
                                    <form @submit.prevent="getPostId(rep.post_id)">
                                        <button
                                            class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                            Delete Post
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div v-else>
                    <h1 class="text-3xl font-bold tracking-tight text-white">All Clear, no Reported Posts</h1>
                </div>
            </div>
        </main>
    </div>
</template>
