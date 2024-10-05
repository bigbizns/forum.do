<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import accheaven from '@/Images/ads/accHeavenLogo.png';
</script>

<template>
    <footer class="bg-gray-800 text-gray-300 py-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">

            <div class="flex justify-center items-center">
                <a href="https://www.accheaven.com/" target="_blank" class="block group cursor-pointer">
                    <img
                        :src="accheaven"
                        alt="Account heaven"
                        class="transition duration-300 ease-in-out transform shadow-lg rounded-md cursor-pointer"
                    />
                </a>
            </div>

            <div class="text-center">
                <h4 class="text-white font-bold mb-2">Quick Links</h4>
                <ul class="space-y-1">
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Home</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">About Us</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Services</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Blog</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Contact</Link></li>
                </ul>
            </div>

            <div class="text-center">
                <h4 class="text-white font-bold mb-2">Usefully Links</h4>
                <ul class="space-y-1">
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">About Us</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Services</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Terms & Rules</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-blue-500">Support</Link></li>
                </ul>
            </div>

            <div class="text-center">
                <h4 class="text-white font-bold mb-2">Sponsored Ad</h4>
                <a href="#">
                    <img src="" alt="Advertise with Us" class="w-full h-40 object-cover border border-gray-600">
                </a>
            </div>
        </div>

        <div class="border-t border-gray-600 mt-8 pt-4 text-center text-sm text-gray-400">
            &copy; 2024 f0rum. All rights reserved.
        </div>
    </footer>
</template>
