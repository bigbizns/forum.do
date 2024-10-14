<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Link,Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="All posts" />

    <Navigation/>
    <div class="mt-20 container h-screen mx-auto p-6">
        <h1 class="text-3xl font-bold text-white mb-6">All Forum Posts</h1>

        <div class="space-y-4">
            <div class="flex flex-row p-3 bg-gray-800 rounded-lg shadow-lg">
                <div>
                    <Link :href="route('user.profile',{id:1})">
                        <img src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960" alt="" class="max-w-12">
                    </Link>
                </div>
                <div class="mx-5">
                    <div class="text-white">
                        <h2 class="font-bold opacity-75">Selling Minecraft Account</h2>
                    </div>
                    <div class="text-gray-100">
                        <p class="opacity-40">saaar please buy my account</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row p-3 bg-gray-800 rounded-lg shadow-lg">
                <div>
                    <Link :href="route('user.profile',{id:2})">
                        <img src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960" alt="" class="max-w-12">
                    </Link>
                </div>
                <div class="mx-5">
                    <div class="text-white">
                        <h2 class="font-bold opacity-75">Post Title 2</h2>
                    </div>
                    <div class="text-gray-100">
                        <p class="opacity-40">This is the content of the second post.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row p-3 bg-gray-800 rounded-lg shadow-lg">
                <div>
                    <Link :href="route('user.profile',{id:3})">
                        <img src="https://imageio.forbes.com/specials-images/imageserve/6170e01f8d7639b95a7f2eeb/Sotheby-s-NFT-Natively-Digital-1-2-sale-Bored-Ape-Yacht-Club--8817-by-Yuga-Labs/0x0.png?format=png&width=960" alt="" class="max-w-12">
                    </Link>
                </div>
                <div class="mx-5">
                    <div class="text-white">
                        <h2 class="font-bold opacity-75">Post Title 3</h2>
                    </div>
                    <div class="text-gray-100">
                        <p class="opacity-40">This is the content of the third post.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Footer/>
</template>
