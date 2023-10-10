<script setup>
import {Link, router} from "@inertiajs/vue3";
import moment from "moment";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import Heading from "../../Components/Heading.vue";
import {onMounted, ref} from "vue";
import CommentSection from "../Course/Partials/CommentSection.vue";

const props = defineProps({
    project: undefined,
});

onMounted(() => {
  router.reload({only: ['project']})
})

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

const projectTab = ref(0)
const tab = ref(1)

const metrics = [
    { id: 1, stat: '8K+', emphasis: 'Companies', rest: 'use laoreet amet lacus nibh integer quis.' },
    { id: 2, stat: '25K+', emphasis: 'Countries around the globe', rest: 'lacus nibh integer quis.' },
    { id: 3, stat: '98%', emphasis: 'Customer satisfaction', rest: 'laoreet amet lacus nibh integer quis.' },
    { id: 4, stat: '12M+', emphasis: 'Issues resolved', rest: 'lacus nibh integer quis.' },
]

</script>

<template>
    <LandingLayout title="Course" desc="Lorem ipsum">

        <div class="pt-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:items-start">
                <div class="px-4 sm:px-6 lg:px-0">
                    <Heading >
                        <template #header>
                            Proyek
                        </template>
                        <template #desc>
                            Lorem ipsum dolor sit amet
                        </template>
                    </Heading>
                </div>

                <div class="relative mx-auto grid lg:grid-cols-6 gap-10 px-4 sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="lg:col-span-2">
                        <div class="mt-3 text-gray-500 space-y-6">
                            <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                                <div class="px-3 py-5 grid gap-3 ">
                                    <h3 class="font-semibold text-gray-900 ml-2">
                                        {{ props.project?.length ?? '0' }} Proyek
                                    </h3>

                                    <template v-for="(list, listIdx) in props.project" :key="list.id">
                                        <button @click="projectTab=listIdx">
                                            <div
                                                class="rounded-3xl py-3 px-5 text-left"
                                                :class="projectTab==listIdx ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                            >
<!--                                                <i class="fa-solid fa-play mr-1"/>-->
                                                {{ list.name }}
                                            </div>
                                        </button>
                                    </template>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 py-3">
                        <template v-for="(item, itemIdx) in props.project">
                            <template v-if="projectTab==itemIdx" class="">
                                <h3 class="text-gray-900 font-semibold text-2xl" v-html="item.name" />
                                <p class="mt-1 mb-5 text-primary-500 font-semibold">
                                    <i class="fa-regular mr-1" :class="item.category.icon"/>
                                    {{ item.category.name }}
                                </p>

                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="item.desc" />

                                <div class="mt-10 pt-10 border-t border-gray-300 flex justify-between items-start gap-10">
                                    <div class="flex items-center flex-none">
                                        <div class="flex-shrink-0">
                                            <Link :href="route('user.show', item.user)">
                                                <img class="h-10 w-10 rounded-full" :src="item.user.profile_photo_url" alt=""/>
                                            </Link>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                <Link :href="route('user.show', item.user)">{{ item.user.name }}</Link>
                                            </p>
                                            <div class="flex space-x-1 text-sm text-gray-500">
                                                <time :datetime="formattedDate(item.created_at)">{{ formattedDate(item.created_at) }}</time>
                                            </div>
                                        </div>
                                    </div>

<!--                                    <div class="">-->
<!--                                        <div class="grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2">-->
<!--                                            <p v-for="item in metrics" :key="item.id">-->
<!--                                                <span class="block text-2xl font-bold text-gray-900">{{ item.stat }}</span>-->
<!--                                                <span class="mt-1 block text-base text-gray-600">-->
<!--                                                  <span class="font-medium text-gray-900">{{ item.emphasis }}</span> {{ item.rest }}-->
<!--                                                </span>-->
<!--                                            </p>-->
<!--                                        </div>-->
<!--                                    </div>-->

                                </div>
                            </template>
                        </template>
                    </div>

                </div>

            </div>
        </div>

    </LandingLayout>

</template>
