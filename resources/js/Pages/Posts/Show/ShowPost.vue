<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import Separator from "@/Components/Separator.vue";
import {getUsDate} from "@/Helpers/getUsDate";
import {computed, ref} from "vue";
import {Link, Head, useForm, usePage} from "@inertiajs/vue3";
import {TradeActionEnum} from "@/Helpers/TradeActionEnum";
import {CommentsInterface} from "@/Types/CommentsInterface";
import UsersPostComment from "@/Components/UsersPostComment.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import reportFlag from '@/Images/report-flag.png';
import ReportPost from "@/Pages/Posts/Report/ReportPost.vue";
import {ReportTypeInterface} from "@/Types/ReportTypeInterface";
import Upvote from "@/Components/Upvote.vue";
import Downvote from "@/Components/Downvote.vue";
import Edit from '@/Images/edit.png';
import EditPost from "@/Pages/Posts/Show/EditPost.vue";
import deletePost from '@/Images/x-button.png';
import DeletePost from "@/Pages/Posts/Show/DeletePost.vue";

const props = defineProps<{
    post: PostInterface
    comments: CommentsInterface[],
    reportTypes: ReportTypeInterface[],
    alreadyReported: boolean,
    votes: PostVotesInterface,
    views: number,
}>();

const page = usePage();
const isReporting = ref<boolean>(false);
const isEditingPost = ref<boolean>(false);
const isDeletingPost = ref<boolean>(false);

const currentUser = page.props.auth?.user?.id;

const toggleReport = () => {
    isReporting.value = !isReporting.value;
};
const toggleEditPost = () => {
    isEditingPost.value = !isEditingPost.value;
};
const toggleDeletePost = () => {
    isDeletingPost.value = !isDeletingPost.value;
};

const formattedDate = computed(() => {
    return getUsDate(props.post.createdAt);
});

const form = useForm({
    comment: null,
});

const vote = useForm({
    vote: false,
});

const setVote = (voteValue: boolean) => {
    vote.vote = voteValue;
    submitVote();
}

const submit = () => {
    form.post(route('post.comment', {id: props.post.id}), {onSuccess: () => form.reset('comment')});
};

const submitVote = () => {
    vote.post(route('post.vote',{id: props.post.id}))
}
</script>

<template>
    <Head :title="post.title"/>
    <Navigation/>

    <template v-if="isReporting">
    <ReportPost @cancel="toggleReport" :post-id="post.id" :report-types="reportTypes"/>
    </template>

    <template v-if="isEditingPost">
        <EditPost @cancel="toggleEditPost" :id="post.id" :title="post.title" :description="post.description"/>
    </template>

    <template v-if="isDeletingPost">
        <DeletePost @cancel="toggleDeletePost" :id="post.id" :title="post.title" :description="post.description"/>
    </template>

    <div class="flex flex-col min-h-screen mb-10">
        <div class="container mx-auto mt-20 p-6 bg-black/40 shadow-md rounded-lg">
            <div class="pb-4 flex justify-between items-center">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-white mr-4">{{ post.title }}</h1>
                    <template v-if="post.tradeAction === TradeActionEnum.Selling">
                        <div class="bg-green-600 text-white rounded-full px-3 py-1 text-xs font-semibold">
                            {{ TradeActionEnum.Selling }}
                        </div>
                    </template>
                    <template v-else-if="post.tradeAction === TradeActionEnum.Buying">
                        <div class="bg-blue-600 text-white rounded-full px-3 py-1 text-xs font-semibold">
                            {{ TradeActionEnum.Buying }}
                        </div>
                    </template>
                </div>
                <div>
                    <template v-if="!alreadyReported && $page.props.auth.user !== null">
                    <img :src="reportFlag" @click="toggleReport" class="w-10 cursor-pointer" alt="report"/>
                    </template>
                    <template v-if="post.user_id === currentUser">
                        <div class="flex gap-3">
                        <img :src="Edit" @click="toggleEditPost" class="w-6 cursor-pointer" alt="edit"/>
                        <img :src="deletePost" @click="toggleDeletePost" class="w-6 cursor-pointer" alt="delete"/>
                        </div>
                    </template>
                </div>
            </div>
            <p class="text-sm text-gray-400">Posted by
                <b class="text-white transition duration-300 hover:text-blue-500">
                <Link :href="route('user.profile',{id: post.author.id})">{{ post.author.username }}</Link>
                </b>
                on {{ formattedDate }}
            </p>
            <div class="mb-6 mt-3">
                <Separator/>
            </div>
            <div class="text-white leading-relaxed mb-6">
                <p class="text-white leading-relaxed mb-6 break-words max-w-full">
                    {{ post.description }}
                </p>
            </div>
            <div class="flex justify-between">
                <div class="flex items-center gap-1">

                </div>
            </div>
            <Separator/>
            <div class="flex justify-between">
                <form @submit.prevent="submitVote" class="flex items-center justify-center gap-4">
                    <div class="flex gap-1">
                    <button type="submit" @click="setVote(true)" v-if="$page.props.auth.user !== null">
                        <Upvote/>
                    </button>
                        <p class="text-green-500">{{ votes.upVote }}</p>
                    </div>
                    <div class="flex gap-1">
                        <p class="text-red-500">{{ votes.downVote }}</p>
                    <button type="submit" @click="setVote(false)" v-if="$page.props.auth.user !== null">
                        <Downvote/>
                    </button>
                    </div>
                </form>
                <div class="flex gap-4 items-center text-white text-sm m-5">
                    <span>Views: {{ views }}</span>
                    <span>Replies: {{ comments.length }}</span>
                </div>
            </div>

            <div class="flex flex-col justify-center" v-if="$page.props.auth.user !== null">
                <form @submit.prevent="submit">
                    <label for="comment" class="mb-5 text-white font-semibold text-xl">Leave Comment</label>
                    <input v-model="form.comment" name="comment" type="text"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                    <small class="text-red-600 font-semibold">{{ form.errors.comment }}</small>
                    <small class="text-green-500 font-semibold">{{ $page.props.flash.message }}</small>
                    <small class="text-yellow-500 font-semibold">{{ $page.props.flash.warning_message }}</small>

                    <div class="w-full flex justify-end mt-4">
                        <PrimaryButton text="Post" type="submit"/>
                    </div>
                </form>
            </div>
            <div v-else>
                <p class="text-white">
                    Be Part of the Discussion
                    <Link :href="route('login')" class="text-white transition duration-200 hover:text-blue-500 cursor-pointer font-semibold">Login</Link>
                    |
                    <Link :href="route('register')" class="text-white transition duration-200 hover:text-blue-500 cursor-pointer font-semibold">Register</Link>
                </p>
            </div>
            <template v-if="comments.length !== 0">
                <div class="mt-10">
                    <div class="bg-black/25 p-5 rounded">
                        <h1 class="text-xl font-semibold text-white">Comments</h1>
                        <div class="flex flex-col gap-3 mt-10">
                            <UsersPostComment
                                v-for="comment in comments"
                                :id="comment.id"
                                :author="comment.author"
                                :comment="comment.comment"
                                :profile-picture="comment.author_avatar"
                                :author-id="comment.authorId"
                                :comment-votes="comment.commentVotes"
                                :edited="comment.edited"
                                :report-types="reportTypes"/>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="mt-10">
                    <div class="bg-black/40 p-5 rounded">
                        <h1 class="text-xl font-semibold text-white">No Comments Yet.</h1>
                    </div>
                </div>
            </template>
        </div>
    </div>
    <Footer/>
</template>
