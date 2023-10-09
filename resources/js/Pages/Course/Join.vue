<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import 'vue3-carousel/dist/carousel.css'
import moment from "moment";
import Heading from "../../Components/Heading.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";

const props = defineProps({
    course: Object,
});

const form = useForm({
    // id: props.course.id,
});

const storeInformation = () => {

    // if (props.course.name == null) {
        form.post(route('course.subscribe', props.course), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => showPage(),
        });
    // } else {
    //     form.put(route('course.update', props.course), {
    //         errorBag: 'updateInformation',
    //         preserveScroll: true,
    //         onSuccess: () => showPage(),
    //     });
    // }
};

const showPage = () => {

};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
</script>

<template>

    <LandingLayout :title="props.course.name">

        <div class="relative pb-10 pt-32 ">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:items-start">
                <div class="px-4 sm:px-6 lg:px-0">
                    <Heading >
                        <template #header>
                            <p class="text-lg text-primary-500 font-medium">
                                <i class="fa-regular fa-cat-space mr-2" />
                                #kamubelumbayar
                            </p>
                            {{ props.course.name }}
                        </template>
                        <template #desc>
                            {{ props.course.desc }}
                        </template>
                    </Heading>

                    <img :src="props.course.media[0].original_url" class="rounded-3xl h-72 aspect-video" />

                    <h4 class="text-gray-700 pt-5">Gabung kelas dengan hanya Rp {{ formatPrice(props.course.price) }}</h4>
                </div>

                <div class="px-4 sm:px-6 lg:px-0 pt-5">
                    <PrimaryButton @click="storeInformation">
                        Saya sudah bayar!
                    </PrimaryButton>
                </div>
            </div>
        </div>


    </LandingLayout>

</template>
