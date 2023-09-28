<script setup>
import {Link} from "@inertiajs/vue3";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";

const props = defineProps({
    blog: Object,
});

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

const products = [
    {
        id: 1,
        name: 'Lorem ipsum',
        desc: 'Dolor sit amet',
        href: '#',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg',
        imageAlt: 'Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls.',
        price: 'Rp 2',
    },

]

</script>

<template>
    <LandingLayout title="Beranda" desc="Lorem ipsum">

        <main class="mx-auto max-w-7xl px-4 h-screen flex justify-center items-center ">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="">Sike</span>
                    <span class="text-primary-600">dar</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua.</p>
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
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8">
                    <h2 class="max-w-md mx-auto text-3xl font-extrabold text-primary-900 text-center lg:max-w-xl lg:text-left">Lorem ipsum dolor sit amet</h2>
                    <div class="flow-root self-center mt-8 lg:mt-0">
                        <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
                            <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                                <img class="h-12" src="https://tailwindui.com/img/logos/workcation-logo-indigo-900.svg" alt="Workcation" />
                            </div>
                            <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                                <img class="h-12" src="https://tailwindui.com/img/logos/tuple-logo-indigo-900.svg" alt="Tuple" />
                            </div>
                            <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                                <img class="h-12" src="https://tailwindui.com/img/logos/level-logo-indigo-900.svg" alt="Level" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="text-xl font-bold text-gray-900">Lorem ipsum</h2>

                <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                    <div v-for="product in products" :key="product.id">
                        <div class="relative">
                            <div class="relative h-72 w-full overflow-hidden rounded-3xl">
                                <img :src="product.imageSrc" :alt="product.imageAlt" class="h-full w-full object-cover object-center" />
                            </div>
                            <div class="relative mt-4">
                                <h3 class="text-sm font-medium text-gray-900">{{ product.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ product.desc }}</p>
                            </div>
                            <div class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
                                <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50" />
                                <p class="relative text-lg font-semibold text-white">{{ product.price }}</p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <PrimaryButton
                                as="a"
                                :href="product.href"
                                class="w-full justify-center"
                            >
                                Beli
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="">
            <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8 divide-y divide-gray-300 dark:divide-gray-700">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Blog</h2>
                    <p class="mt-3 text-xl text-gray-500 sm:mt-4">Nullam risus blandit ac aliquam justo ipsum. Quam mauris volutpat massa dictumst amet. Sapien tortor lacus arcu.</p>
                </div>
                <div class="mt-12 grid gap-16 pt-12 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">
                    <div v-for="blog in props.blog" :key="blog.name">
                        <div>
                            <Link :href="route('blog.show', blog)" class="inline-block">
                                <span :class="['bg-pink-500', 'inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium']">{{ blog.category.name }}</span>
                            </Link>
                        </div>
                        <Link :href="route('blog.show', blog)" class="mt-4 block">
                            <p class="text-xl font-semibold text-gray-900">{{ blog.name }}</p>
                            <p class="mt-3 text-base text-gray-500">{{ blog.desc }}</p>
                        </Link>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <Link :href="route('user.show', blog.user)">
                                    <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt="" />
                                </Link>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <Link :href="route('user.show', blog.user)">{{ blog.user.name }}</Link>
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time :datetime="blog.created_at">{{ blog.created_at }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </LandingLayout>

</template>
