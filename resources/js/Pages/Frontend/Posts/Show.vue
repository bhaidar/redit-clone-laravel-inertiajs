<script setup>
import { computed } from "vue";
import NavLink from "@/Components/NavLink.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    community: Object,
    post: Object,
});

const postData = computed(() => props.post.data);

const form = useForm({
    content: '',
});

const submit = () => {
    form.post(route('frontend.posts.comments', [props.community.slug, props.post.data.slug]), {
        onSuccess: () => form.reset('content'),
    });
};
</script>

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
                        <div v-if="postData.is_owner">
                            <NavLink class=""
                                :href="route('communities.posts.edit', [community, postData])">
                                Edit
                            </NavLink>
                            <NavLink class="ml-2" method="delete" as="button"
                                type="button"
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
                <div>
                    <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
                        <li v-for="(comment, index) in postData.comments"
                            :key="index" class="py-4 flex flex-col">
                            <div class="text-sm text-slate-400">
                                Commented by
                                <span
                                    class="font-semibold ml-1 text-slate-700">{{
                                    comment.username
                                    }}</span>
                            </div>
                            <div class="text-slate-600 m-2 p-2">
                                {{ comment.content }}
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="md:p-2 my-2 mt-4"
                    v-if="$page.props.auth.auth_check">
                    <form class="max-w-md" @submit.prevent="submit">
                        <div class="mt-2">
                            <label for="comment" class="
                      block
                      mb-2
                      text-sm
                      font-medium
                      text-gray-900
                      dark:text-gray-400
                    ">Your comment</label>
                            <textarea v-model="form.content" id="comment"
                                rows="4" class="
                      block
                      p-2.5
                      w-full
                      text-sm text-gray-900
                      bg-gray-50
                      rounded-lg
                      border border-gray-300
                      focus:ring-blue-500 focus:border-blue-500
                      dark:bg-gray-700
                      dark:border-gray-600
                      dark:placeholder-gray-400
                      dark:text-white
                      dark:focus:ring-blue-500
                      dark:focus:border-blue-500
                    " placeholder="Your comment..."></textarea>
                        </div>
                        <div class="mt-2">
                            <button class="
                      px-4
                      py-2
                      bg-blue-500
                      hover:bg-blue-700
                      text-white
                      rounded-md
                    ">
                                Comment
                            </button>
                        </div>
                    </form>
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
