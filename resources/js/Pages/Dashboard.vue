<script setup>
import {ref, watch} from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, useForm, router} from "@inertiajs/vue3";
import MobileMenu from "@/Components/MobileMenu.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import moment from "moment";
import { Swiper, SwiperSlide } from 'swiper/vue';
import { FreeMode, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/autoplay';
import {Vue3Lottie} from "vue3-lottie";

const props = defineProps({
    course: Object,
    project: Object,
    course_me: Object,
    project_me: Object
})

function formattedDate(value) {
    return moment(value).format('DD MMM Y | HH:m')
}

function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

const breakpoints = {
    500: {
        itemsToShow: 2,
        snapAlign: 'center',
    },
    700: {
        itemsToShow: 2,
        snapAlign: 'center',
    },
    // 1024 and up
    1024: {
        itemsToShow: 3,
        snapAlign: 'center',
    },
}

const onSwiper = (swiper) => {
    // console.log(swipeMenu);
};
const onSlideChange = (swiper) => {
    // console.log(swipeMenu);
};

const cards = [
    { name: 'Kelas dari saya', href: 'course.index', icon: 'fa-book', amount: props.course.length },
    { name: 'Kelas untuk saya', href: 'course.index', icon: 'fa-book-user', amount: props.course_me?.length },
    { name: 'Proyek dari Saya', href: 'project.index', icon: 'fa-browser', amount: props.project.length },
    { name: 'Proyek untuk Saya', href: 'project.index', icon: 'fa-browsers', amount: props.project_me?.length },
]
</script>

<template>
    <AppLayout title="Beranda"
               greeting="Selamat datang kembali,"
               :name="$page.props.user.name"
               :desc="$page.props.user.email"
               :avatar="$page.props.user.profile_photo_url"
    >
        <div class="rounded-3xl bg-gradient-to-br from-primary-600 overflow-hidden shadow-lg">
            <div class="py-4 px-4 sm:px-6 lg:py-8 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <div class="tracking-tight nightwind-prevent-block" >
                    <span class="block text-sm font-medium text-white">
                        Selamat Datang
                    </span>
                    <span class="block text-lg font-bold text-white">
<!--                        <span class="text-sm font-medium">Rp</span> {{ formatPrice($page.props.user.wallet_balance) }}-->
                        Aplikasi SIKEDAR dari Universitas Lampung.
                    </span>
                </div>
                <div class="mt-5 flex lg:mt-0 lg:flex-shrink-0 gap-x-2">
<!--                    <PrimaryButton as="a" :href="route('deposit.index')" class="text-sm">-->
<!--                        <i class="fa-solid fa-circle-plus mr-2" />-->
<!--                        Isi Ulang-->
<!--                    </PrimaryButton>-->

<!--                    <SecondaryButton as="a" :href="route('money-transfer.index')" class="text-sm nightwind-prevent">-->
<!--                        <i class="fa-solid fa-circle-up mr-2" />-->
<!--                        Kirim Uang-->
<!--                    </SecondaryButton>-->
                </div>
            </div>
        </div>

<!--        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">-->
<!--            <div class="p-6 flex gap-6">-->
<!--                <div class="flex-none flex items-center">-->
<!--&lt;!&ndash;                    <Vue3Lottie&ndash;&gt;-->
<!--&lt;!&ndash;                        animation-link="https://lottie.host/2931601b-3cd5-49f3-a709-ebb26aeab426/60gPnD5Xwz.json"&ndash;&gt;-->
<!--&lt;!&ndash;                        :height="80"&ndash;&gt;-->
<!--&lt;!&ndash;                    />&ndash;&gt;-->
<!--                    <i class="fa-duotone fa-ghost text-7xl text-primary-600" />-->
<!--                </div>-->
<!--                <div class="grow">-->
<!--                    <h4 class="text-gray-900 font-semibold">Selamat Bergabung!</h4>-->
<!--                    <p class="text-sm text-gray-600">SIKEDAR siap membantu</p>-->
<!--&lt;!&ndash;                    <Link href="" class="text-sm text-primary-600 font-medium">Link <i class="fa-regular fa-arrow-right" /></Link>&ndash;&gt;-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


        <div class="">
            <div class="mt-10">
                <h2 class="text-lg font-medium leading-6 text-gray-900">Ringkasan</h2>
                <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Card -->
                    <div v-for="card in cards" :key="card.name" class="overflow-hidden rounded-3xl bg-white bg-opacity-50 shadow-lg border border-gray-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fa-duotone text-primary-600 text-3xl" :class="card.icon" />
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="truncate text-sm font-medium text-gray-500">{{ card.name }}</dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ card.amount }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-300">
                            <div class="text-sm">
                                <Link :href="route(card.href)" class="font-medium text-cyan-700 hover:text-cyan-900">Lihat semua</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--        <swiper-->
<!--            :modules="[Autoplay]"-->
<!--            :slides-per-view="1"-->
<!--            :space-between="10"-->
<!--            :autoplay="{-->
<!--                delay: 5000,-->
<!--                disableOnInteraction: false,-->
<!--            }"-->
<!--            :breakpoints="{-->
<!--                '640': {-->
<!--                    slidesPerView: 2,-->
<!--                    spaceBetween: 10,-->
<!--                },-->
<!--                '768': {-->
<!--                    slidesPerView: 2,-->
<!--                    spaceBetween: 10,-->
<!--                },-->
<!--                '1024': {-->
<!--                    slidesPerView: 3,-->
<!--                    spaceBetween: 10,-->
<!--                },-->
<!--            }"-->
<!--        >-->
<!--            <template v-for="slide in props.carousel" :key="slide.id" >-->
<!--                <SwiperSlide>-->
<!--                    <Link :href="slide.href" >-->
<!--                        <img :src="slide.media[0].original_url" alt="" class="rounded-3xl w-full h-auto aspect-video object-cover p-1">-->
<!--                    </Link>-->
<!--                </SwiperSlide>-->
<!--            </template>-->
<!--        </swiper>-->

        <MobileMenu/>
    </AppLayout>
</template>
