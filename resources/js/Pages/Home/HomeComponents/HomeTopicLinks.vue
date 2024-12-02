<script setup lang="ts">
import TopicLink from "@/Pages/Home/HomeComponents/TopicLink.vue";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Navigation } from 'vue3-carousel';
import { CategoryInterface } from "@/Types/CategoryInterface";

defineProps<{
    categories: CategoryInterface[]
}>();
</script>

<template>
    <div class="flex items-center rounded-lg">
        <Carousel
            :itemsToShow="5"
            class="hidden md:block w-full"
            wrapAround>
            <Slide
                v-for="category in categories"
                :key="category.id"
                class="px-2">
                <TopicLink :title="category.title" :slug="category.slug" />
            </Slide>
            <template #addons>
                <Navigation />
            </template>
        </Carousel>

        <Carousel
            :itemsToShow="1"
            class="md:hidden w-full"
            wrapAround>
            <Slide
                v-for="category in categories"
                :key="category.id"
                class="px-2">
                <TopicLink :title="category.title" :slug="category.slug" />
            </Slide>
            <template #addons>
                <Navigation />
            </template>
        </Carousel>
    </div>
</template>
