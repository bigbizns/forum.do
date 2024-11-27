<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import Post from "@/Components/Post.vue";

defineProps<{
    title: string,
    searchPosts: PostInterface[]
}>();

const emit = defineEmits<{
    (e: 'cancel'): void;
}>();

const cancel = () => {
    emit('cancel');
};
</script>

<template>
    <div
        class="z-10 inset-0 flex items-center justify-center transition-opacity duration-300 ease-out w-full"
        @click="cancel">
        <div class="z-30 bg-black/50 p-8 rounded-lg shadow-lg transform w-full flex flex-col gap-3" @click.stop>
            <Post
                v-for="post in searchPosts"
                :key="post.title"
                :user_id="post.user_id"
                :trade-action="post.tradeAction"
                :description="post.description"
                :id="post.id"
                :avatar="post.avatar"
                :title="post.title"/>
            <div class="flex justify-end">
                <Link :href="route('post.searched.posts',{title: title})" class="text-blue-500">Show all</Link>
            </div>
        </div>
    </div>
</template>
