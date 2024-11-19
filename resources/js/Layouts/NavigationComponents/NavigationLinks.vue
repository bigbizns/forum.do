<script setup lang="ts">
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";
import NavigationForumsTabModal from "@/Layouts/NavigationComponents/NavigationForumsTabModal.vue";

const forumsModalOpen = ref<boolean>(false);
const toggleForumModal = () => {
    forumsModalOpen.value = !forumsModalOpen.value;
};
</script>

<template>
    <ul class="hidden md:flex space-x-8 ">
        <li>
            <Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Home</Link>
        </li>
        <li>
            <div @click="toggleForumModal" class="flex items-center duration-300 transition cursor-pointer hover:text-blue-500 group">Forum
                <svg class="w-3 ml-2 group-hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15l-8-8h16z"/></svg>
            </div>
        </li>
        <template v-if="forumsModalOpen">
            <NavigationForumsTabModal/>
        </template>
        <li>
        <Link :href="route('post.create')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Create Post</Link>
        </li>
        <li>

            <Link :href="route('contactus')" class="duration-300 transition hover:text-blue-500">Contact</Link>
        </li>
    </ul>
</template>

<style scoped>

</style>
