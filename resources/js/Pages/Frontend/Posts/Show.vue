<template>
    <GuestLayout>
        <section class="flex md:flex-row p-2 m-2">
            <div class="w-8/12">
                <h1>{{ post.title }}</h1>
                Post Details
            </div>
            <div class="w-4/12 p-2 ml-4">
                <div class="p-2 bg-slate-500 text-white">
                    <h2>Latest Communities</h2>
                </div>
            </div>
        </section>

    </GuestLayout>
</template>

<script setup>
import { computed } from "vue";
import NavLink from "@/Components/NavLink.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    community: Object,
    post: Object,
});

const hasPosts = computed(() => props.posts?.data.length > 0);
</script>

<style>

</style>
