<script setup lang="ts">
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import {computed} from "vue";
import user from "@/Images/user.png";
import {usePage} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import Separator from "@/Components/Separator.vue";

const {props} = usePage();

const userHasAvatar = computed(() => {
    return props.auth.user.avatar ? `/storage/${props.auth.user.avatar}` : user;
});
</script>

<template>
    <div class="max-w-sm">
        <Popover v-slot="{ open }" class="relative">
            <PopoverButton
                :class="open ? 'text-white' : 'text-white/90'"
                class="group inline-flex items-center rounded-md text-base font-medium"
            >
                <img
                    :src="userHasAvatar"
                    alt="User Avatar"
                    class="w-7 h-7 object-cover rounded-full cursor-pointer"
                    :class="{'bg-white': !$page.props.auth.user.avatar}">
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
                    class="absolute left-1/2 z-10  w-screen max-w-sm -translate-x-1/2 transform px-4 sm:px-0 lg:max-w-[18vh]"
                >
                    <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black/5">
                        <div class="flex flex-col relative gap-1 bg-black/80 p-4">
                            <Link
                                :href="route('account.profile')"
                                class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Profile
                            </Link>
                            <Link
                                :href="route('payment.add.funds')"
                                class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Add Funds
                            </Link>
                            <Link
                                :href="route('dashboard.index')"
                                class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Dashboard
                            </Link>
                            <template v-if="$page.props.auth.user.is_admin">
                                <Link
                                    :href="route('admin.dashboard.index')"
                                    class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Admin
                                    Dashboard
                                </Link>
                            </template>
                            <Separator/>
                            <Link
                                :href="route('account.settings')"
                                class="py-2 hover:text-blue-500 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">Settings
                            </Link>
                            <Link
                                :href="route('logout')" method="post"
                                class="text-red-500 py-2 hover:text-red-600 w-fit h-fit cursor-pointer transition duration-200 ease-in-out">
                                Logout
                            </Link>
                        </div>
                    </div>
                </PopoverPanel>
            </transition>
        </Popover>
    </div>
</template>
