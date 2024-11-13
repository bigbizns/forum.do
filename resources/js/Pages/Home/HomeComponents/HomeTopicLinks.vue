<script setup lang="ts">
import TopicLink from "@/Pages/Home/HomeComponents/TopicLink.vue";
import 'vue3-carousel/dist/carousel.css'
import { Carousel, Slide, Navigation } from 'vue3-carousel'
import {CategoryInterface} from "@/Types/CategoryInterface";

defineProps<{
    categories: CategoryInterface[]
}>();

const config = {
    itemsToShow: 5,
    wrapAround: true,
};
</script>

<template>
    <div class="flex items-center rounded-lg">
        <Carousel v-bind="config" class="w-full">
            <Slide v-for="category in categories" :key="category.id">
                <TopicLink :title="category.title"/>
            </Slide>
            <template #addons>
                <Navigation />
            </template>
        </Carousel>
    </div>
</template>
