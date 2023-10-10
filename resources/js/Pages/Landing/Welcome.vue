<script setup>
import {Link, router} from "@inertiajs/vue3";
import moment from "moment";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Heading from "../../Components/Heading.vue";
import {onMounted} from "vue";

const props = defineProps({
    course: undefined,
    blog: undefined,
});

onMounted(() => {
    router.reload({only: ['course', 'blog']})
})

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>
    <LandingLayout title="Beranda" desc="Lorem ipsum">

        <main class="mx-auto max-w-7xl px-4 h-screen flex justify-center items-center ">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    Pelajari Skills Baru
                    Sesuai Dengan Minatmu
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">Anim
                    aute id
                    magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat
                    veniam
                    occaecat fugiat aliqua.</p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8 gap-5">
                    <PrimaryButton as="a" :href="route('dashboard')">
                        Dasbor
                    </PrimaryButton>

                    <SecondaryButton>
                        Lorem ipsum
                    </SecondaryButton>
                </div>
            </div>
        </main>

        <div class="">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-wrap space-x-10">
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <img class="h-12" src="https://tailwindui.com/img/logos/workcation-logo-indigo-900.svg"
                             alt="Workcation"/>
                    </div>
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <img class="h-12" src="https://tailwindui.com/img/logos/tuple-logo-indigo-900.svg" alt="Tuple"/>
                    </div>
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <img class="h-12" src="https://tailwindui.com/img/logos/level-logo-indigo-900.svg" alt="Level"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <Heading>
                    <template #header>
                        Kelas
                    </template>

                    <template #desc>
                        Belajar membangun website yang dinamis seperti toko online dengan teknologi web development
                        terbaru
                    </template>
                </Heading>

                <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">

                    <div v-for="item in props.course" :key="item.id">
                        <Link :href="route('course.show', item)">
                            <div class="bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">
                                <div class="h-52 w-full overflow-hidden rounded-t-3xl">
                                    <img :src="item.media[0].original_url" :alt="item.name"
                                         class="rounded-t-3xl h-full w-full object-cover object-center"/>
                                </div>
                                <div class="py-3 px-5 items-end">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ item.name }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ item.desc }}</p>
                                    <p class="mt-1 text-sm font-semibold text-gray-700">
                                        <template v-if="item.has_subscribed">
                                            <i class="fa-duotone fa-circle-check text-green-600 mr-1"/> Akses selamanya
                                        </template>
                                        <template v-else>
                                            Rp {{ formatPrice(item.price) }}
                                        </template>
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <Heading>
                    <template #header>
                        Artikel
                    </template>
                    <template #desc>
                        Belajar membangun website yang dinamis seperti toko online dengan teknologi web development
                        terbaru
                    </template>
                </Heading>

                <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                    <div v-for="blog in props.blog" :key="blog.name">
                        <div>
                            <Link :href="route('blog.show', blog)" class="inline-block">
                <span
                    :class="['bg-primary-300 text-primary-900', 'inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium']">
                  {{ blog.category.name }}
                </span>
                            </Link>
                        </div>
                        <Link :href="route('blog.show', blog)" class="mt-4 block">
                            <p class="text-xl font-semibold text-gray-900">{{ blog.name }}</p>
                            <p class="mt-3 text-base text-gray-500">{{ blog.desc }}</p>
                        </Link>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <Link :href="route('user.show', blog.user)">
                                    <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt=""/>
                                </Link>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="route('user.show', blog.user)">{{ blog.user.name }}</Link>
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time :datetime="formattedDate(blog.created_at)">{{
                                            formattedDate(blog.created_at)
                                        }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </LandingLayout>

</template>
