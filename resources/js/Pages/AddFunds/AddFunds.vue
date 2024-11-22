<script setup lang="ts">
import Footer from "@/Layouts/Footer.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormInput from "@/Components/FormInput.vue";
import {Head} from "@inertiajs/vue3";
import Navigation from "@/Layouts/Navigation.vue";
</script>

<template>
    <Head title="Add Funds"/>
    <Navigation/>
    <div class="h-screen flex items-center">
        <div class="mt-20 mb-5 w-full max-w-3xl mx-auto p-8 bg-black/40 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-white">Add Funds</h2>
            <p class="text-xl font-bold mb-6 text-white"> *<b>NOTICE</b>* Only accept crypto payments</p>
            <form class="space-y-6">
                <div>
                    <FormInput label="amount" label-name="Amount" type="number" error="" model-value="s"/>
                </div>
                <div class="flex justify-between">
                </div>
                <PrimaryButton text="Proceed" type="submit" class="w-full"/>
            </form>
        </div>
    </div>
    <Footer/>
</template>
