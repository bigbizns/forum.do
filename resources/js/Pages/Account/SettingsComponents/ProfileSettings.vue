<script lang="ts" setup>
import type {UserInterface} from "@/Types/UserInterface";
import {useForm} from "@inertiajs/vue3";
import FormInput from "@/Components/FormInput.vue";

const props = defineProps<{
    userData: UserInterface
}>();

const form = useForm({
    username: props.userData.username ?? null,
    email: props.userData.email ?? null,
    description: props.userData.description ?? null,
});

const submit = () => {
    if ((props.userData.username === form.username) && (props.userData.email === form.email) && (props.userData.description === form.description)) {
        return;
    }

    form.post(route('account.settings.store'));
};
</script>

<template>
    <section class="bg-black/40 p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl text-gray-300 font-semibold mb-4">Profile Settings</h2>

        <div class="flex items-start gap-6">
            <form @submit.prevent="submit" class="flex-1 space-y-4">
                <div class="flex gap-6">
                    <div class="w-1/2">
                    <FormInput v-model="form.username" label="name" label-name="Name" type="text" :error="form.errors.username ?? ''"/>
                    </div>
                    <div class="w-1/2">
                        <FormInput v-model="form.email" label="email" label-name="Email" type="email" :error="form.errors.email ?? ''"/>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-gray-300 font-medium mb-1">Description</label>
                    <textarea
                        v-model="form.description"
                        id="description"
                        rows="3"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                        :class="{'border-red-500':form.errors.description}" placeholder="Tell us a little about yourself">
                    </textarea>
                    <small class="text-red-600 font-semibold">{{ form.errors.description }}</small>
                </div>
                <small class="text-green-500 font-semibold">{{ $page.props.flash.profile_message }}</small>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">Save Changes</button>
                </div>
            </form>
        </div>
    </section>
</template>
