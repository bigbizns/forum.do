<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

defineProps<{
    title: string,
    description: string,
    id: number
}>();
</script>

<template>
    <Link :href="route('post.show',{id:id})">
        <div class="flex bg-gray-800 shadow-xl cursor-pointer rounded flex-row p-3">
            <div>
                <Link :href="route('user.profile',{id:1})">
                    <img
                        src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960"
                        alt="" class="max-w-12">
                </Link>
            </div>
            <div class="mx-5">
                <div class="text-white">
                    <h2 class="font-bold opacity-75">{{ title }}</h2>
                </div>
                <div class="text-gray-100">
                    <p class="opacity-40">{{ description }}</p>
                </div>
            </div>
        </div>
    </Link>
</template>
