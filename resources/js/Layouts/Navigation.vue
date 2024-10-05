<script lang="ts" setup>
import {Link, usePage} from '@inertiajs/vue3';
import user from '@/Images/user.png';
import {computed} from "vue";

const {props} = usePage();

const userHasAvatar = computed(() => {
    return props.auth.user.avatar ? `/storage/${props.auth.user.avatar}` : user
});
</script>

<template>
  <nav class="bg-black/60 text-white shadow-md fixed top-0 w-full z-50">
    <div class="flex items-center justify-between p-4 mx-auto max-w-7xl">
      <a href="#" class="text-2xl font-bold">f0rum</a>
      <ul class="hidden md:flex space-x-8 ">
        <li><Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Home</Link></li>
        <li><Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Forums</Link></li>
        <li><Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Contact</Link></li>
      </ul>
      <div class="hidden md:flex space-x-4 ">
          <template v-if="!$page.props.auth.user">
              <Link :href="route('login')" class="duration-300 transition hover:text-blue-500">Login</Link>
              <Link :href="route('register')" class="duration-300 transition hover:text-blue-500">Register</Link>
          </template>
          <template v-else>
              <img :src="userHasAvatar"
                   alt="User Avatar"
                   class="w-7 h-7 object-cover rounded-full shadow-2xl"
                    :class="{'bg-white':!$page.props.auth.user.avatar}"
              >
          </template>
      </div>
      <div class="md:hidden">
        <svg class="w-8 h-8 text-white cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </div>
    </div>
  </nav>
</template>
