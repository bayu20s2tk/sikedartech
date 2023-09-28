<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";

import 'vue3-carousel/dist/carousel.css'
import {Carousel, Slide, Pagination, Navigation} from 'vue3-carousel'
import {Editor, EditorContent, useEditor} from '@tiptap/vue-3'
import StarterKit from "@tiptap/starter-kit";

const props = defineProps({
    blog: Object,
});

const editor = useEditor({
    content: props.blog.content,
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl p-3 mt-3',
        },
    },
    extensions: [
        StarterKit.configure({
            paragraph: {
                HTMLAttributes: {
                    class: 'text-base text-gray-600',
                },
            },
            Heading: {
                HTMLAttributes: {
                    class: 'text-gray-900',
                },
            },
        })
    ],
    autofocus: false,
    editable: false,
})

</script>

<template>

    <LandingLayout :title="props.blog.name">

<!--        <template #header>-->
<!--            {{ blog.name }}-->
<!--        </template>-->

        <div class="relative pb-10 pt-32">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">
                <div class="relative sm:py-16 lg:py-0">
                    <div aria-hidden="true" class="hidden sm:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-screen">
                        <div class="absolute inset-y-0 right-1/2 w-full bg-primary-500 rounded-r-2xl lg:right-72" />
                        <svg class="absolute top-8 left-1/2 -ml-3 lg:-right-8 lg:left-auto lg:top-12" width="404" height="392" fill="none" viewBox="0 0 404 392">
                            <defs>
                                <pattern id="02f20b47-fd69-4224-a62a-4c9de5c763f7" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                                </pattern>
                            </defs>
                            <rect width="404" height="392" fill="url(#02f20b47-fd69-4224-a62a-4c9de5c763f7)" />
                        </svg>
                    </div>
                    <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0 lg:max-w-none lg:py-20">
                        <!-- Testimonial card-->
<!--                            <img class="absolute inset-0 h-full w-full object-cover" :src="blog.media[0].original_url" alt="" />-->
                            <Carousel v-if="blog.media[0]" :items-to-show="1" :wrap-around="true" :transition="1000" :autoplay="5000">
                                <template #slides>
                                    <Slide v-for="media in blog.media" :key="media.id">
                                        <div class="carousel__item w-full aspect-square rounded-2xl relative">
                                            <img class="object-cover w-full aspect-square rounded-2xl" :src="media.original_url">
                                        </div>
                                    </Slide>
                                </template>
                                <template #addons>
<!--                                        <Navigation />-->
                                        <Pagination/>
                                </template>
                            </Carousel>
                    </div>
                </div>

                <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="pt-12 sm:pt-16 lg:pt-20">
                        <h2 class="text-3xl text-gray-900 font-extrabold tracking-tight sm:text-4xl capitalize">{{ blog.name }}</h2>
                        <div class="mt-3 text-gray-500 space-y-6">
                            <p class="capitalize text-primary-500"><i class="fa-regular mr-2" :class="blog.category.icon" />{{ blog.category.name }}</p>

                            <EditorContent
                                :editor="editor"
                                required />

                        </div>
                    </div>

                    <!-- Stats section -->
<!--                    <div class="mt-10">-->
<!--                        <dl class="grid grid-cols-2 gap-x-4 gap-y-8">-->
<!--                            <div v-for="stat in stats" :key="stat.label" class="border-t-2 border-gray-300 pt-6">-->
<!--                                <dt class="text-base font-medium text-gray-500">{{ stat.label }}</dt>-->
<!--                                <dd class="text-3xl font-extrabold tracking-tight text-gray-900">{{ stat.value }}</dd>-->
<!--                            </div>-->
<!--                        </dl>-->
<!--                    </div>-->

                    <div class="mt-10 pt-10 flex items-center border-t border-gray-300">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt="" />
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">
                                <span class="hover:underline">
                                    {{ blog.user.name }}
                                </span>
                            </div>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <span>
                                    {{ blog.user.email }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </LandingLayout>

</template>
