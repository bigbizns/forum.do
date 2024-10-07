<script setup lang="ts">
import {UserInterface} from "@/Types/UserInterface";
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import UserDetails from "@/Pages/UserAccount/Components/UserDetails.vue";
import UserStatus from "@/Pages/UserAccount/Components/UserStatus.vue";
import ActivityCard from "@/Pages/UserAccount/Components/ActivityCard.vue";
import RecentPostCard from "@/Pages/UserAccount/Components/RecentPostCard.vue";

const props = defineProps<{
    userData: UserInterface
}>();
</script>

<template>
<Navigation/>
    <div class="min-h-screen mt-10 py-8">
        <UserDetails :user-data="userData"/>
            <!--@TODO:ADD REAL TRACKING OF USERS COMMENTS,LIKES,POINTS-->
        <UserStatus  :user-data="props.userData"/>

        <div class="max-w-5xl mx-auto mt-6 bg-black/40 p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-xl font-semibold mb-3">Description</h3>
            <p class="text-gray-300 leading-relaxed">
                {{props.userData.description ?? 'No information given.'}}
            </p>
        </div>

        <div class="max-w-5xl mx-auto mt-6 bg-black/40 p-6 rounded-lg shadow-md">
            <h3 class="text-xl text-gray-500 font-semibold mb-3">Recent Activity</h3>
            <div class="space-y-4">
               <ActivityCard/>
            </div>
        </div>

        <div class="max-w-5xl mx-auto mt-6 bg-black/40 p-6 rounded-lg shadow-md">
            <h3 class="text-xl text-gray-500 font-semibold mb-3">Recent Posts</h3>
            <div class="space-y-4">
                <RecentPostCard/>
            </div>
        </div>
    </div>
    <Footer/>
</template>
