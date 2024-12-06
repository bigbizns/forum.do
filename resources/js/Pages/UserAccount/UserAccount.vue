<script setup lang="ts">
import {UserInterface, UsersPostsInterface, UserStatsInterface} from "@/Types/UserInterface";
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import UserDetails from "@/Pages/UserAccount/Components/UserDetails.vue";
import UserStatus from "@/Pages/UserAccount/Components/UserStatus.vue";
import ActivityCard from "@/Pages/UserAccount/Components/ActivityCard.vue";
import RecentPostCard from "@/Pages/UserAccount/Components/RecentPostCard.vue";
import {Head} from "@inertiajs/vue3";
import {ReportTypeInterface} from "@/Types/ReportTypeInterface";

const props = defineProps<{
    userData: UserInterface,
    userPosts: UsersPostsInterface[],
    userStats: UserStatsInterface,
    reportTypes: ReportTypeInterface[]
}>();
</script>

<template>
    <Head :title=userData.username />
    <Navigation/>
    <div class="min-h-screen mt-12 py-8">
        <div class="flex justify-center">
        <small class="text-xl text-green-500">{{$page.props.flash.message}}</small>
        <small class="text-xl text-yellow-500">{{$page.props.flash.warning_message}}</small>
        </div>
        <UserDetails :user-data="userData" :report-types="reportTypes"/>
        <UserStatus  :user-data="props.userData" :user-stats="userStats"/>
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
                <RecentPostCard :user-posts="userPosts"/>
            </div>
        </div>
    </div>
    <Footer/>
</template>
