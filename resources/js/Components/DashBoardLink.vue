<script lang="ts" setup>
import {Link} from "@inertiajs/vue3";
import {route} from "ziggy-js";

const props = defineProps<{
    href: string;
}>();

const checkIfRouteActive = (routeName: string) => {
    return route().current(routeName);
};
</script>

<template>
    <Link :href="route(href)"
          :class="checkIfRouteActive(href) ?
          'rounded-md px-3 py-2 text-sm font-medium text-blue-500 transition duration-300 hover:text-blue-400'
          : 'rounded-md px-3 py-2 text-sm font-medium text-white transition duration-300 hover:text-blue-500'">
        <slot/>
    </Link>
</template>
