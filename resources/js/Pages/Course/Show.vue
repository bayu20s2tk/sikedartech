<script setup>
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Heading from "@/Components/Heading.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PreviousButton from "../../Components/PreviousButton.vue";
import Badge from "../../Components/Badge.vue";
// import BidList from "./Partials/BidList.vue";

const props = defineProps({
    course: Object,
    subscriber: Number
});

const tab = ref(null)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>
    <AppLayout
        title="Kelas"
        name="Kelas"
        desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton />
        </template>

        <div class="max-w-7xl mx-auto items-start">
            <div class="flex justify-between gap-3">
                <div class="">
                    <h1 class="text-xl font-medium leading-6 text-gray-900">{{ props.course.name }}</h1>
                </div>

                <div class="">
                    <PrimaryButton as="a" :href="route('course.edit', props.course)" >Ubah Data</PrimaryButton>
                </div>
            </div>

            <div>
                <!--                <h3 class="text-lg font-medium leading-6 text-gray-900">Last 30 days</h3>-->
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{ props.course.status }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Member</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{ props.subscriber }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Author</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 flex items-center">
<!--                            <img :src="props.course.user.profile_photo_url" class="h-10 w-10 rounded-full object-cover mr-2" />-->
                            {{ props.course.user.name }}
                        </dd>
                    </div>
                </dl>
            </div>

<!--            <div class="mt-10 rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">-->
<!--                <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">-->
<!--                    <template v-for="bid in props.course.bid">-->
<!--                        <BidList :bid="bid" />-->
<!--                    </template>-->

<!--                </ul>-->
<!--            </div>-->
        </div>


    </AppLayout>

</template>
