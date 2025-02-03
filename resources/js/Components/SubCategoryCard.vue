<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {SubCategoryInterface} from "@/Types/SubCategoryInterface";
import {SubCategoryEnum} from "@/Enums/SubCategoryEnum";
import CS2Logo from '@/Images/CS2Logo.png';
import WarzoneLogo from '@/Images/WarzoneLogo.jpg';
import PUBGLogo from '@/Images/pubgLogo.png';
import SteamLogo from '@/Images/SteamLogo.png';
import LoLLogo from '@/Images/LoLLogo.png';
import DotaLogo from '@/Images/dota2logo.png';
import OtherLogo from '@/Images/otherLogo.png';

defineProps<{
    subCategories: SubCategoryInterface[],
}>();
</script>
<!--TODO: Check How to store Images in DB-->
<template>
    <Link
        v-for="sub in subCategories"
        :href="route('subCategory.index', {subCategory: sub.slug})"
        :id="sub.id" >
        <div class="flex bg-gray-800 shadow-xl hover:bg-gray-700 transition duration-200 cursor-pointer rounded flex-row p-3">
            <div class="mx-5">
                <div class="text-white flex items-center gap-2">
                    <template v-if="sub.keyword === SubCategoryEnum.CS2">
                    <img :src="CS2Logo" class="w-7 rounded" alt="cs2">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.DOTA">
                        <img :src="DotaLogo" class="w-7 rounded" alt="Dota">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.PUBG">
                        <img :src="PUBGLogo" class="w-7 rounded" alt="PUBG">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.WARZONE">
                        <img :src="WarzoneLogo" class="w-7 rounded" alt="War zone">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.STEAM">
                        <img :src="SteamLogo" class="w-7 rounded" alt="Steam">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.LOL">
                        <img :src="LoLLogo" class="w-7 rounded" alt="LoL">
                    </template>
                    <template v-if="sub.keyword === SubCategoryEnum.OTHER">
                        <img :src="OtherLogo" class="w-7 rounded" alt="Other">
                    </template>
                    <h2 class="font-bold opacity-75">{{ sub.title }}</h2>
                </div>
            </div>
        </div>
    </Link>
</template>
