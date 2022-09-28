<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    community: Object,
});

const form = useForm({
    title: '',
    description: '',
    url: '',
});

const submit = () => {
    form.post(route('communities.posts.store', props.community.slug));
};
</script>

<template>

    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post for <span class="text-2xl">{{
                community.name }}</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="max-w-md bg-white rounded-lg shadow-lg m-2 p-6 mx-auto">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text"
                                class="mt-1 block w-full" v-model="form.title"
                                required autofocus autocomplete="title" />
                            <InputError class="mt-2"
                                :message="form.errors.title" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="url" value="Url" />
                            <TextInput id="url" type="url"
                                class="mt-1 block w-full" v-model="form.url"
                                required autocomplete="url" />
                            <InputError class="mt-2"
                                :message="form.errors.url" />
                        </div>
                        <div class="mt-4">
                            <InputLabel for="description" value="Description" />
                            <TextInput id="description" type="text"
                                class="mt-1 block w-full"
                                v-model="form.description" required
                                autocomplete="description" />
                            <InputError class="mt-2"
                                :message="form.errors.description" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Store
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>

</style>
