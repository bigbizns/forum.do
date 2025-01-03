<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {PageNumbersInterface, PaginationInterface} from "@/Types/PaginationInterface";

defineProps<{
    pagination: PaginationInterface
    pageNumbers: PageNumbersInterface[]
}>();
</script>

<template>
    <nav class="mt-10 w-full">
        <ul class="inline-flex -space-x-px text-base h-10">
            <Link
                preserve-scroll
                :href="pagination.prev_page_url"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-gray-800 rounded transition duration-150 hover:text-gray-700  dark:text-gray-400 dark:hover:text-white"
            >
                Previous
            </Link>
            <Link
                v-for="numbers in pageNumbers"
                preserve-scroll
                :href="`?page=${numbers.page}`"
                :class="{
                'flex items-center justify-center px-4 h-10 leading-tight text-blue-500 transition duration-150': numbers.page == pagination.current_page,
                'flex items-center justify-center px-4 h-10 leading-tight text-white hover:text-blue-500 transition duration-150': numbers.page != pagination.current_page
            }"
            >
                {{ numbers.page }}
            </Link>
            <Link
                preserve-scroll
                :href="pagination.next_page_url"
                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-gray-800 rounded transition duration-150 hover:text-gray-700  dark:text-gray-400 dark:hover:text-white"
            >
                Next
            </Link>
        </ul>
    </nav>
</template>
