<script setup lang="ts">
import Downvote from "@/Components/Downvote.vue";
import Upvote from "@/Components/Upvote.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps<{
    commentId: string,
    commentVotes: {
        upVote: number,
        downVote: number
    }
}>();
const vote = useForm({
    vote: false,
});

const setVote = (voteValue: boolean) => {
    vote.vote = voteValue;
    submitVote();
};

const submitVote = () => {
    vote.post(route('post.comment.vote', {id: props.commentId}));
};
</script>

<template>
    <form @submit.prevent="submitVote" class="flex items-center justify-center gap-4">
        <div class="flex gap-1">
            <button type="submit" @click="setVote(true)">
                <Upvote/>
            </button>
            <p class="text-green-500">{{ commentVotes.upVote }}</p>
        </div>
        <div class="flex gap-1">
            <p class="text-red-500">{{ commentVotes.downVote }}</p>
            <button type="submit" @click="setVote(false)">
                <Downvote/>
            </button>
        </div>
    </form>
</template>
