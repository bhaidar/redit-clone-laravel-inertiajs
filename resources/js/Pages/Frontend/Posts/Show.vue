<template>
    <GuestLayout>
        <section class="flex flex-col md:flex-row p-2 m-2">
            <div class="w-full md:w-8/12">
                <div class="p-1 md:m-2 bg-white">
                    <NavLink
                        class="font-semibold text-2xl text-black hover:border-white"
                        :href="route('frontend.communities.show', community)">
                        <h2 class="">
                            r/{{ community.name }}
                        </h2>
                    </NavLink>
                </div>
                <div class="p-2 md:mx-2 my-2 bg-white text-sm text-slate-400">
                    <div class="flex flex-col justify-between md:flex-row">
                        <div>
                            Posted by <span class="ml-1 text-slate-700">{{
                            postData.username }}</span>
                        </div>
                        <div>
                            <NavLink
                                class="font-semibold text-blue-500 hover:text-blue-700 hover:border-white"
                                :href="route('communities.posts.edit', [community, postData])">
                                Edit
                            </NavLink>
                            <NavLink
                                class="font-semibold text-red-500 hover:text-red-700 hover:border-white"
                                :href="route('communities.posts.destroy', [community, postData])">
                                Delete
                            </NavLink>
                        </div>
                    </div>
                    <h1 class="font-semibold text-3xl text-black">
                        {{ postData.title }}
                    </h1>
                    <p class="text-slate-400 my-2">{{ postData.description
                    }}
                    </p>
                    <a class="font-semibold mb-2 text-blue-500 text-sm hover:border-white hover:text-blue-300"
                        :href="postData.url">
                        {{ postData.url }}
                    </a>
                </div>
            </div>
            <div class="w-full md:w-4/12 md:p-2 md:ml-4 mt-4 md:mt-0">
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

const postData = computed(() => props.post.data);
</script>

<style>

</style>
