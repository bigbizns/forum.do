<script setup lang="ts">

import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {Head} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Terms & Rules"/>
    <Navigation/>
    <div class="min-h-screen flex justify-center items-center">
        <section class="max-w-4xl mx-auto p-6 bg-black/40 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-white">Terms & Rules</h2>
            <p class="text-white mb-6">
                Please read and adhere to the following terms and rules while using our forum. Your participation is
                subject to these guidelines to ensure a safe and respectful environment for everyone.
            </p>
            <ul class="list-disc list-inside space-y-4 text-white">
                <li>
                    <strong>Respect Others:</strong> Treat all members with respect. Harassment, hate speech, and
                    abusive behavior will not be tolerated.
                </li>
                <li>
                    <strong>Stay on Topic:</strong> Keep discussions relevant to the forum sections. Off-topic posts may
                    be removed.
                </li>
                <li>
                    <strong>No Spam:</strong> Do not post spam or promotional content. This includes irrelevant links.
                </li>
                <li>
                    <strong>Privacy:</strong> Respect the privacy of other members. Do not share personal information
                    without consent.
                </li>
                <li>
                    <strong>Legal Compliance:</strong> All discussions must comply with applicable laws. Do not engage
                    in illegal activities.
                </li>
                <li>
                    <strong>Moderation:</strong> Follow the instructions of the moderators and administrators. They have
                    the final say on rule enforcement.
                </li>
            </ul>
            <p class="text-white mt-6">
                By participating in our forum, you agree to adhere to these terms and rules. Thank you for contributing
                to our community!
            </p>
        </section>
    </div>
    <Footer/>
</template>

<style scoped>

</style>
