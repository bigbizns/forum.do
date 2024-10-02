<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <footer class="bg-gray-800 text-gray-300 py-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">

            <div>
                <img src="" alt="Your Logo">
                <p class="text-sm">Accheaven Premium Social accounts & Social services.</p>
            </div>
            <!-- @TODO: Discuss about the links in the footer and ADS-->
            <div>
                <h4 class="text-white font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><Link href="#" class="transition duration-300 hover:text-white">Home</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">About Us</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Services</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Blog</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Contact</Link></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4"> Usefully Links</h4>
                <ul class="space-y-2">
                    <li><Link href="#" class="transition duration-300 hover:text-white">About Us</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Services</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Terms & Rules</Link></li>
                    <li><Link href="#" class="transition duration-300 hover:text-white">Support</Link></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4">Sponsored Ad</h4>
                <a href="#">
                    <img src="" alt="Advertise with Us" class="w-full h-32 object-cover border border-gray-600">
                </a>
            </div>

        </div>

        <div class="border-t border-gray-600 mt-8 pt-4 text-center text-sm text-gray-400">
            <!-- @TODO: When we get the name change it-->
            &copy; 2024 f0rum. All rights reserved.
        </div>
    </footer>
</template>
