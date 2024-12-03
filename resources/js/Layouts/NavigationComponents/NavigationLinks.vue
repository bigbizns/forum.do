<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {Popover, PopoverButton, PopoverPanel} from "@headlessui/vue";
</script>

<template>
    <ul class="hidden md:flex space-x-8 ">
        <li>
            <Link :href="route('home')" class="duration-300 transition hover:text-blue-500">Home</Link>
        </li>
            <div class="max-w-sm">
                <Popover v-slot="{ open }" class="relative">
                    <PopoverButton :class="open ? 'text-white' : 'text-white/90'" class="group inline-flex items-center rounded-md text-base font-medium transition duration-300 hover:text-blue-500">
                        Forum
                    </PopoverButton>
                    <transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="translate-y-1 opacity-0"
                        enter-to-class="translate-y-0 opacity-100"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="translate-y-0 opacity-100"
                        leave-to-class="translate-y-1 opacity-0"
                    >
                        <PopoverPanel
                            class="absolute left-1/2 z-10  w-screen max-w-sm -translate-x-1/2 transform lg:max-w-[20vh]">
                            <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
                                <div class="flex flex-col relative gap-2 bg-black/80 p-2 px-5">
                                    <Link :href="route('forum')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">All Forum posts</Link>
                                </div>
                            </div>
                        </PopoverPanel>
                    </transition>
                </Popover>
            </div>
        <li>
        <Link :href="route('post.create')" class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Create Post</Link>
        </li>
        <li>
            <Link :href="route('contactus')" class="duration-300 transition hover:text-blue-500">Contact</Link>
        </li>
    </ul>
</template>
