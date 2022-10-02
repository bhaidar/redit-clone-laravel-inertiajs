<script setup>
import { computed } from "vue";
import NavLink from "@/Components/NavLink.vue";
import PostCard from "@/Components/PostCard.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    community: Object,
    posts: Object,
});

const hasPosts = computed(() => props.posts?.data.length > 0);
</script>

<template>
    <GuestLayout>
        <template #header>
            <div class="flex justify-between align-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    r/{{ community.slug }}
                </h2>
                <NavLink v-if="$page.props.auth.auth_check"
                    :href="route('communities.posts.create', community.slug)">
                    Create Post</NavLink>
            </div>
        </template>

        <section class="flex md:flex-row p-2 m-2">
            <div class="w-8/12">
                <PostCard v-for="(post, idx) in posts.data" :key="post.id"
                    :post="post" :community="community.slug"
                    :class="{ 'mt-6' : idx > 0 }" />
                <div class="mt-4 p-2" v-if="hasPosts">
                    <Pagination :links="posts.meta.links" />
                </div>
            </div>
            <div class="w-4/12 p-2 ml-4">
                <div class="p-2 bg-slate-500 text-white">
                    <h2>Latest Communities</h2>
                </div>
            </div>
        </section>

    </GuestLayout>
</template>
