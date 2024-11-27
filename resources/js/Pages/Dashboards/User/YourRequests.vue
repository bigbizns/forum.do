<script setup lang="ts">
import {Head, Link} from "@inertiajs/vue3";
import UserDashBoardNav from "@/Components/UserDashBoardNav.vue";
import {EditRequestsInterface} from "@/Types/EditRequestsInterface";
import DashboardHeader from "@/Layouts/DashboardHeader.vue";

defineProps<{
    requests: EditRequestsInterface[]
}>();
</script>

<template>
    <Head title="Dashboard Your Requests"/>
    <div class="min-h-full">
        <UserDashBoardNav/>

        <DashboardHeader/>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div v-for="req in requests" :key="req.id" class="flex justify-between gap-x-6 py-5 bg-black/40 mb-2 p-2 rounded shadow-xl">
                    <div class="flex min-w-0 gap-x-4">
                        <div class="min-w-0 flex-auto">
                            <div class="flex gap-3 items-center">
                                <Link :href="route('post.show', { id: req.post_id })"
                                      class="text-sm/6 font-semibold text-white duration-300 transition hover:text-blue-500">
                                    {{ req.title }}
                                </Link>
                            </div>
                            <p class="mt-1 truncate text-xs/5 text-white">Request To: <b>{{ req.action }}</b></p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
