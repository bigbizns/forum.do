<script lang="ts" setup>
import {computed, ref} from "vue";
import user from '@/Images/user.png';
import {Link, usePage} from '@inertiajs/vue3';
import NavigationGuestAuth from "@/Layouts/NavigationComponents/NavigationGuestAuth.vue";
import NavigationProfileModal from "@/Layouts/NavigationComponents/NavigationProfileModal.vue";
import NavigationLinks from "@/Layouts/NavigationComponents/NavigationLinks.vue";
import logo from "@/Images/logo1.png";

const {props} = usePage();

const modalOpen = ref<boolean>(false);

const userHasAvatar = computed(() => {
    return props.auth.user.avatar ? `/storage/${props.auth.user.avatar}` : user;
});

const toggleModal = () => {
    modalOpen.value = !modalOpen.value;
};
</script>

<template>
    <nav class="bg-black/60 text-white shadow-lg fixed top-0 w-full z-50">
        <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">

            <Link :href="route('home')" class="text-2xl font-bold flex items-center gap-2"><img :src="logo" alt="logo" class="w-10"><p class="text-sm">forum.do</p></Link>
            <NavigationLinks/>
            <div class="hidden md:flex space-x-4 ">
                <template v-if="!$page.props.auth.user">
                    <NavigationGuestAuth/>
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
                            <NavigationProfileModal/>
                        </template>
                    </div>
                </template>
            </div>
            <div @click="toggleModal" class="md:hidden">
                <svg class="w-8 h-8 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </div>
        </div>
    </nav>
</template>
