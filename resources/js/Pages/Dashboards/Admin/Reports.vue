<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminDashboardNav from "@/Components/AdminDashboardNav.vue";
import {ReportsInterface} from "@/Types/adminDashUsersInterface";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";
import user from "@/Images/user.png";
import {AdminDashboardEnum} from "@/Enums/AdminDashboardEnum";

defineProps<{
    reports: ReportsInterface[]
}>();

const form = useForm({
    postId: ''
});
const profileForm = useForm({
    reportId: '',
    profileId: ''
})

const commentForm = useForm({
    reportId: '',
    commentId: ''
});

const getPostId = (postId: string) => {
    form.postId = postId;

    submitPostDelete();
};
const getProfileId = (profileId: string, reportId: string) => {
    profileForm.reportId = reportId;
    profileForm.profileId = profileId;

    submitProfileDelete();
}
const getCommentId = (commentId: string, reportId:string) => {
    commentForm.commentId = commentId;
    commentForm.reportId = reportId;

    submitCommentDelete();
}

const submitPostDelete = () => {
    form.post(route('admin.dashboard.delete.reported.post'));
};
const submitProfileDelete = () => {
    profileForm.post(route('admin.dashboard.delete.reported.user'));
};
const submitCommentDelete = () => {
    commentForm.post(route('admin.dashboard.delete.reported.comment'));
}
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
                            <div class="flex flex-col items-center p-2">
                                <Link :href="route('user.profile', { id: rep.userId })">
                                    <img
                                        :src="rep.avatar ? `/storage/${rep.avatar}` : user"
                                        alt=""
                                        class="max-w-12 rounded-full border-2 bg-white border-gray-600 shadow-lg">
                                </Link>
                                <p class="text-white mt-1">{{ rep.userName }}</p>
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p class="mt-1 truncate text-xl text-white">{{ rep.reason }}</p>
                                <p class="mt-1 truncate text-m text-white">{{ rep.message }}</p>
                                <div class="flex gap-2">
                                    <template v-if="rep.type === AdminDashboardEnum.Post">
                                        <Link :href="route('post.show',{id: rep.postId})"
                                              class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                            Check Post
                                        </Link>
                                        <form @submit.prevent="getPostId(rep.postId)">
                                            <button
                                                class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                                Delete Post
                                            </button>
                                        </form>
                                    </template>
                                    <template v-else-if="rep.type === AdminDashboardEnum.Profile">
                                        <Link :href="route('user.profile',{id: rep.reportedUserId})"
                                              class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                            Check Profile
                                        </Link>
                                        <form @submit.prevent="getProfileId(rep.reportedUserId, rep.id)">
                                            <button
                                                class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                                Delete Profile
                                            </button>
                                        </form>
                                    </template>
                                    <template v-if="rep.type === AdminDashboardEnum.Comment">
                                        <form @submit.prevent="getCommentId(rep.commentId, rep.id)">
                                            <button
                                                class="mt-1 truncate text-m text-blue-500 cursor-pointer duration-300 transition hover:text-blue-400">
                                                Delete Comment
                                            </button>
                                        </form>
                                    </template>
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
