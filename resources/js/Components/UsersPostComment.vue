<script setup lang="ts">
import user from "@/Images/user.png";
import {Link} from "@inertiajs/vue3";

const props = defineProps<{
    author: string,
    comment: string,
    profilePicture: string
    authorId: string,
}>();
</script>

<template>
    <div class="flex bg-gray-800 shadow-lg rounded-lg overflow-hidden p-4">
        <div class="flex-shrink-0 flex flex-col items-center w-24">
            <img
                :src="props.profilePicture ? `/storage/${props.profilePicture}` : user"
                alt=""
                class="w-16 h-16 rounded-full border-2 bg-white border-gray-600 shadow-lg mb-2">
            <Link :href="route('user.profile', { id: props.authorId })"
                  class="text-white font-bold text-sm transition duration-200 hover:text-blue-500">
                {{ author }}
            </Link>
        </div>
        <div class="ml-6 flex items-center">
            <div>
                <p class="text-white text-l break-words">
                    {{ comment }}
                </p>
            </div>
        </div>
    </div>
</template>
