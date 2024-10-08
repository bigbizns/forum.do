<script lang="ts" setup>
import user from "@/Images/user.png";
import {UserInterface} from "@/Types/UserInterface";
import {getUsDate} from "@/Helpers/getUsDate";

const props = defineProps<{
    userData: UserInterface
}>();
console.log(props);

</script>

<template>
    <div class="max-w-5xl mx-auto bg-black/40 shadow-md rounded-lg overflow-hidden">
        <div class="relative px-6 py-4">
            <div class="left-6 flex gap-5 items-center">
                <img :src="props.userData.avatar ? `/storage/${props.userData.avatar}` : user" alt="User Avatar" class="w-32 h-32 rounded-full shadow-md">
                <div class="flex flex-col">
                    <h2 class="text-2xl text-gray-300 font-bold">{{ props.userData.username }}</h2>
                    <div class="flex gap-3">
                    <b class="text-gray-500">Member Since: </b> <p class="text-gray-300">{{ getUsDate(props.userData.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
