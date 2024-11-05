<script setup lang="ts">
import Footer from "@/Layouts/Footer.vue";
import {Head, useForm} from "@inertiajs/vue3";
import Navigation from "@/Layouts/Navigation.vue";
import FormInput from "@/Components/FormInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { CategoryInterace } from "@/Types/CategoryInterace";
import {CreatePostInterface} from "@/Types/CreatePostInterface";
import {watch} from "vue";
import {SubCategoryInterface} from "@/Types/SubCategoryInterface";

const props = defineProps<{
    categories: CategoryInterace[],
    subCategories: SubCategoryInterface[],
    tradeActions: TradeActionInterface[],
}>();

let catSubCategories: SubCategoryInterface[] = [];

const form = useForm<CreatePostInterface>({
    title: null,
    category: null,
    subCategory: null,
    tradeAction: null,
    description: null,
    pinned: false,
});

watch(() => form.category, () => {
    let catId = form.category?.id;

    catSubCategories = props.subCategories.filter((item) => item.category_id === catId);
});

const submit = () => {
    form.post(route('post.store'), {onSuccess: () => form.reset('title', 'category', 'pinned', 'description')});
};
</script>

<template>
    <Head title="Create Post"/>
    <Navigation/>
    <div class="mt-20 mb-5 max-w-3xl mx-auto p-8 bg-black/40 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-white">Create Post</h2>
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <FormInput v-model="form.title" label="title" label-name="Title" type="text" :error="form.errors.title"/>
            </div>
            <div class="flex justify-between">
                <div class="w-full max-w-xs">
                    <label for="category" class="block text-sm font-medium text-white mb-2">Select Category</label>
                    <select v-model="form.category" id="category" name="category"
                            class="block w-full p-2.5 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option v-for="category in categories" :value="category" :key="category.id">
                            {{ category.title }}
                        </option>
                    </select>
                    <small class="text-red-600 font-semibold">{{ form.errors.category }}</small>
                </div>
                <template v-if="form.category?.marketplace === 1">
                    <div class="w-full max-w-xs">
                        <label for="category" class="block text-sm font-medium text-white mb-2">Trade Action</label>
                        <select v-model="form.tradeAction" id="tradeAction" name="tradeAction"
                                class="block w-full p-2.5 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="action in tradeActions" :value="action.value">
                                {{ action.name }}
                            </option>
                        </select>
                        <small class="text-red-600 font-semibold">{{ form.errors.tradeAction }}</small>
                    </div>
                </template>
            </div>
                <template v-if="catSubCategories.length != 0">
                    <div class="w-full max-w-l">
                        <label for="category" class="block text-sm font-medium text-white mb-2">Sub Category</label>
                        <select v-model="form.subCategory"  id="tradeAction" name="tradeAction"
                                class="block w-full p-2.5 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option v-for="subCategory in catSubCategories" :value="subCategory.id">
                                {{ subCategory.title }}
                            </option>
                        </select>
                        <small class="text-red-600 font-semibold">{{ form.errors.tradeAction }}</small>
                    </div>
                </template>
            <div>
                <label for="description" class="block text-sm font-medium text-white">Description</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    rows="5"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Write your post content here..."
                ></textarea>
                <small class="text-red-600 font-semibold">{{ form.errors.description }}</small>
            </div>
            <div>
                <label class="inline-flex items-center mt-3">
                    <input
                        type="checkbox"
                        v-model="form.pinned"
                        class="form-checkbox h-5 w-5 text-blue-600"
                    />
                    <span class="ml-2 text-white">Pin this post</span>
                </label>
            </div>
                <PrimaryButton text="Post" type="submit" class="w-full"/>
        </form>
    </div>
    <Footer/>
</template>
