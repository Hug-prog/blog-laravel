<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm, usePage } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article created by {{ $page.props.article.auth }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ $page.props.article.title }}
                        <div>
                            {{ $page.props.article.content }}
                        </div>
                    </div>
                </div>

                <div
                    class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <a
                            :href="
                                route('Comment.Create', [
                                    `${$page.props.article.id}`,
                                ])
                            "
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Create a new Comment
                            <svg
                                aria-hidden="true"
                                class="w-4 h-4 ml-2 -mr-1"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div
                        class="mt-6 p-6 text-gray-900"
                        v-for="content of $page.props.comments"
                    >
                        <div
                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
                        >
                            <a href="#">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                >
                                    {{ content.auth }}
                                </h5>
                            </a>
                            <p
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                            >
                                {{ content.content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
