<template>
    <GuestLayout>
        <template #header>
            <div class="flex justify-between align-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    r/{{ community.name }}
                </h2>
                <NavLink v-if="$page.props.auth.auth_check"
                    :href="route('communities.posts.create', community.slug)">
                    Create Post</NavLink>
            </div>
        </template>

        <section class="p-2 m-2">
            <PostCard v-for="post in posts.data" :key="post.id" :post="post"
                :community="community" />
        </section>

    </GuestLayout>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import PostCard from "@/Components/PostCard.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    community: Object,
    posts: Object,
});
</script>

<style>

</style>
