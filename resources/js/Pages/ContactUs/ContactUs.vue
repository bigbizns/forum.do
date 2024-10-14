<script setup lang="ts">
import Navigation from "@/Layouts/Navigation.vue";
import Footer from "@/Layouts/Footer.vue";
import {TopicsInterface} from "@/Types/TopicsInterface";
import {Head, useForm} from "@inertiajs/vue3";

const props = defineProps<{
    topics: TopicsInterface[]
}>();

const form = useForm({
    topic: '',
    message: null,
});

const submit = () => {
    form.post(route('contactus.store'), {onSuccess: () => form.reset('topic', 'message')});
}
</script>

<template>
    <Head title="Contact Us"/>
    <Navigation/>
        <div class="mt-20 h-screen">
            <div class="mt-20 mb-5 max-w-3xl mx-auto p-8 bg-black/40 shadow-lg rounded-lg">
                <h2 class="text-2xl font-bold mb-6 text-white">Contact</h2>
                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <div class="w-full max-w-xs">
                            <label for="feedback" class="block text-sm font-medium text-white mb-2">Topic</label>
                            <select v-model="form.topic" id="feedback" name="feedback" class="block w-full p-2.5 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="" selected disabled>Select</option>
                                <option v-for="topic in topics" :value="topic.name">{{ topic.value }}</option>
                            </select>
                            <small class="text-red-600 font-semibold ">{{form.errors.topic}}</small>
                        </div>

                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-white">Message</label>
                        <textarea
                            v-model="form.message"
                            id="message"
                            rows="5"
                            class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Write your message here..."
                        ></textarea>
                        <small class="text-red-600 font-semibold ">{{form.errors.message}}</small>
                        <small class="text-green-500 font-semibold">{{$page.props.flash.message}}</small>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-md shadow-md transition duration-300 ease-in-out">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <Footer/>
</template>
