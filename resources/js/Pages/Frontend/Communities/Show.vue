<template>
    <GuestLayout>
        <h1>Subreddit Show Page</h1>
        {{ community }}
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    community: Object,
});
</script>

<style>

</style>
