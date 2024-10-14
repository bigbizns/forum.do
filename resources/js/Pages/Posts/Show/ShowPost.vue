<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import Separator from "@/Components/Separator.vue";
import {getUsDate} from "@/Helpers/getUsDate";
import {computed} from "vue";
import {Link,Head} from "@inertiajs/vue3";

const props = defineProps<{
    post: PostInterface
}>();

const formattedDate = computed(() => {
    return getUsDate(props.post.createdAt);
});

</script>

<template>
    <Head :title="post.title"/>
    <Navigation/>
    <div class="h-screen">
        <div class="container mx-auto mt-20 p-6 bg-black/40 shadow-md rounded-lg">
            <div class="pb-4">
                <h1 class="text-2xl font-bold text-white">{{ post.title }}</h1>
                <p class="text-sm text-gray-400">Posted by <b class="text-white transition duration-300 hover:text-blue-500">
                    <Link :href="route('user.profile',{id: post.author.id})">{{ post.author.username }}</Link>
                </b> on {{ formattedDate }}
                </p>
            </div>
            <div class="mb-6">
                <Separator/>
            </div>
            <div class="text-white leading-relaxed mb-6">
                <p>
                    {{ post.description }}
                </p>
            </div>

            <div class="flex justify-between items-center text-white text-sm">
                <span>Views: 0</span>
                <span>Replies: 0</span>
            </div>
        </div>
    </div>
    <Footer/>
</template>

