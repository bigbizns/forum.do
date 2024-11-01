<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <Link :href="route('login')" class="duration-300 transition hover:text-blue-500">Login</Link>
    <span>|</span>
    <Link :href="route('register')" class="duration-300 transition hover:text-blue-500">Register</Link>
</template>
