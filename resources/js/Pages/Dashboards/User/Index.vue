<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import UserDashBoardNav from "@/Components/UserDashBoardNav.vue";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";

</script>

<template>
    <Head title="Dashboard"/>
    <div class="min-h-full">
        <UserDashBoardNav/>

        <DashboardHeader/>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <!--Content-->
            </div>
        </main>
    </div>

</template>
