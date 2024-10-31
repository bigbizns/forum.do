<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

defineProps<{
        pagination: PaginationInterface
}>();
</script>

<template>
    <div class="flex items-center gap-5 mt-4">
        <Link
            preserve-scroll
            v-if="pagination.prev_page_url"
            :href="pagination.prev_page_url"
            class="text-white px-4 py-2 bg-gray-800 rounded transition duration-200 hover:bg-gray-500">
            Previous
        </Link>
        <Link
            preserve-scroll
            v-if="pagination.next_page_url"
            :href="pagination.next_page_url"
            class="text-white px-4 py-2 bg-gray-800 rounded transition duration-200 hover:bg-gray-500">
            Next
        </Link>
        <p class="text-white text-sm">
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
        </p>
    </div>
</template>
