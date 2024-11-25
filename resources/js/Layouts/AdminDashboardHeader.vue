<script setup lang="ts">

</script>

<template>
    <header class="bg-black/40 shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex gap-2 items-center">
            <h1 class="text-3xl font-bold tracking-tight text-white">Dashboard</h1>
            <h1 class="text-3xl font-semibold text-green-500">{{ $page.props.flash.message }}</h1>
        </div>
    </header>
</template>
