<script setup lang="ts">
import user from "@/Images/user.png";
import {Link, usePage} from "@inertiajs/vue3";
import UsersPostCommentForm from "@/Components/UsersPostCommentForm.vue";
import {ref} from "vue";
import EditComment from "@/Pages/Posts/Show/EditComment.vue";
import editLogo from '@/Images/edit.png';

defineProps<{
    id: string,
    author: string,
    comment: string,
    profilePicture: string,
    edited: number,
    authorId: number,
    commentVotes: {
        upVote: number,
        downVote: number
    }
}>();

const page = usePage();
const currentUser = page.props.auth?.user?.id;
const edit = ref<boolean>(false);

const toggleEdit = () => {
    edit.value = !edit.value
};
</script>

<template>
    <template v-if="edit">
        <EditComment @cancel="toggleEdit" :comment="comment" :comment-id="id"/>
    </template>
    <div class="flex bg-gray-800 shadow-lg rounded-lg overflow-hidden p-4">
        <div class="flex-shrink-0 flex flex-col items-center w-24">
            <img
                :src="profilePicture ? `/storage/${profilePicture}` : user"
                alt=""
                class="w-16 h-16 rounded-full border-2 bg-white border-gray-600 shadow-lg mb-2">
            <Link :href="route('user.profile', { id: authorId })"
                  class="text-white font-bold text-sm transition duration-200 hover:text-blue-500">
                {{ author }}
            </Link>
            <UsersPostCommentForm :comment-id="id" :comment-votes="commentVotes"/>
            <div>
                <p v-if="edited === 1" class="text-gray-500">
                    Edited
                </p>
            </div>
        </div>
        <div class="ml-6 flex-grow flex items-center break-words w-52">
            <p class="text-white text-l leading-relaxed break-words flex-grow overflow-hidden">
                {{ comment }}
            </p>
        </div>

        <template v-if="authorId === currentUser">
            <img :src="editLogo" alt="Edit" class="w-6 h-6 cursor-pointer" @click="toggleEdit">
        </template>
    </div>
</template>
