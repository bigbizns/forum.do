<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

defineProps<{
    title: string,
    slug: string
}>();
</script>

<template>
    <Link :href="route('subCategory.get', { Category: slug })"
          class="px-8 py-4 m-2 hover:bg-gray-700 transition duration-300 text-opacity text-white rounded text-gray">
        {{ title }}
    </Link>
</template>
