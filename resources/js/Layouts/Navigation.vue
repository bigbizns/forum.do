<script lang="ts" setup>
  import { Link } from '@inertiajs/vue3';
</script>

<template>
  <nav class="bg-black/60 text-white shadow-md fixed top-0 w-full z-50">
    <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
      <a href="#" class="text-2xl font-bold">f0rum</a>
      <ul class="hidden md:flex space-x-8 text-lg font-semibold">
        <li><Link :href="route('home')" class="hover:text-blue-500">Home</Link></li>
        <li><Link :href="route('home')" class="hover:text-blue-500">Forums</Link></li>
        <li><Link :href="route('home')" class="hover:text-blue-500">Contact</Link></li>
      </ul>
      <div class="hidden md:flex space-x-4">
        <Link :href="route('login')" class="hover:text-blue-500">Login</Link>
        <Link :href="route('register')" class="hover:text-blue-500">Register</Link>
      </div>
      <div class="md:hidden">
        <svg class="w-8 h-8 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </div>
    </div>
  </nav>
</template>
