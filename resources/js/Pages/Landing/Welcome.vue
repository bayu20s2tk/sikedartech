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
                <div class="mt-5 max-w-md mx-auto flex justify-center md:mt-8 gap-3">
                    <PrimaryButton as="a" :href="route('dashboard')">
                        Dasbor
                    </PrimaryButton>

<!--                    <SecondaryButton>-->
<!--                        Lorem ipsum-->
<!--                    </SecondaryButton>-->
                </div>
            </div>
        </main>

<!--        <div class="">-->
<!--            <div class="max-w-7xl mx-auto px-4">-->
<!--                <div class="flex flex-wrap space-x-10">-->
<!--                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">-->
<!--                        <img class="h-12" src="https://tailwindui.com/img/logos/workcation-logo-indigo-900.svg"-->
<!--                             alt="Workcation"/>-->
<!--                    </div>-->
<!--                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">-->
<!--                        <img class="h-12" src="https://tailwindui.com/img/logos/tuple-logo-indigo-900.svg" alt="Tuple"/>-->
<!--                    </div>-->
<!--                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">-->
<!--                        <img class="h-12" src="https://tailwindui.com/img/logos/level-logo-indigo-900.svg" alt="Level"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

    </LandingLayout>

</template>
