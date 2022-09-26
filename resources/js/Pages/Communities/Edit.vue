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
    name: props.community?.name,
    description: props.community?.description,
});

const submit = () => {
    form.put(route('communities.update', props.community?.slug));
};
</script>

<template>

    <Head title="Create Community" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Community
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="max-w-md bg-white rounded-lg shadow-lg m-2 p-6 mx-auto">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" type="text"
                                class="mt-1 block w-full" v-model="form.name"
                                required autofocus autocomplete="name" />
                            <InputError class="mt-2"
                                :message="form.errors.name" />
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
                                Update
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
