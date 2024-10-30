<script lang="ts" setup>
import { Link, usePage } from '@inertiajs/vue3';
import user from '@/Images/user.png';
import { computed, ref } from "vue";
import Separator from "@/Components/Separator.vue";
import logo from "@/Images/bg1.png";

const { props } = usePage();

const modalOpen = ref<boolean>(false);
const forumsModalOpen = ref<boolean>(false);

const userHasAvatar = computed(() => {
    return props.auth.user.avatar ? `/storage/${props.auth.user.avatar}` : user;
});

const toggleModal = () => {
    modalOpen.value = !modalOpen.value;
};
const toggleForumModal = () => {
    forumsModalOpen.value = !forumsModalOpen.value;
};
</script>

<template>
    <nav class="bg-black/60 text-white shadow-lg fixed top-0 w-full z-50">
        <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">

            <Link :href="route('home')" class="text-2xl font-bold flex items-center gap-2"><img :src="logo" alt="logo" class="w-10"><p class="text-sm">forum.do</p></Link>
            <ul class="hidden md:flex space-x-8 ">
                <li><Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Home</Link></li>
                <li>
                    <div @click="toggleForumModal" class="flex items-center duration-300 transition cursor-pointer hover:text-blue-500 group">
                        Forums
                        <svg class="w-3 ml-2 group-hover:fill-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 15l-8-8h16z"/></svg>
                    </div>
                </li>
                <template v-if="forumsModalOpen">
                    <div class="flex flex-col text-black absolute top-14 right-50 bg-white w-40 rounded-lg shadow-lg p-2 border border-gray-200 z-50">
                        <Link :href="route('forum')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">All Forum posts</Link>
                        <Link :href="route('post.create')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Create Post</Link>
                    </div>
                </template>
                <li><Link :href="route('contactus')" class="duration-300 transition hover:text-blue-500">Contact</Link></li>
            </ul>
            <div class="hidden md:flex space-x-4 ">
                <template v-if="!$page.props.auth.user">
                    <Link :href="route('login')" class="duration-300 transition hover:text-blue-500">Login</Link>
                    <span>|</span>
              <Link :href="route('register')" class="duration-300 transition hover:text-blue-500">Register</Link>
                </template>
                <template v-else>
                    <div class="relative inline-block">
                        <img :src="userHasAvatar"
                             @click="toggleModal"
                             alt="User Avatar"
                             class="w-7 h-7 object-cover rounded-full shadow-2xl cursor-pointer"
                             :class="{'bg-white': !$page.props.auth.user.avatar}"
                        >
                        <template v-if="modalOpen">
                            <div class="flex flex-col text-black absolute top-8 right-0 bg-white w-40 rounded-lg shadow-lg p-2 border border-gray-200 z-50">
                                <Link :href="route('account.profile')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Profile</Link>
                                <Link :href="route('account.settings')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Settings</Link>
                                <Separator />
                                <Link :href="route('logout')" method="post" class="text-red-600 py-2 hover:text-red-400 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Logout</Link>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
            <div @click="toggleModal" class="md:hidden">
                <svg class="w-8 h-8 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
        </div>
    </nav>
</template>
