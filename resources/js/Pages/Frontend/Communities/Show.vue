<template>
    <GuestLayout>
        <div class="flex justify-end m-2 p-2">
            <NavLink v-if="$page.props.auth.auth_check" href="" class="">Create
                Post</NavLink>
        </div>
        <h1>Subreddit Show Page</h1>
        {{ community }}
    </GuestLayout>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    community: Object,
});
</script>

<style>

</style>
