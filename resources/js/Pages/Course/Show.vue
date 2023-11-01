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
import BidList from "../Project/Partials/BidList.vue";
import MemberList from "./Partials/MemberList.vue";

const props = defineProps({
    course: Object,
    subscriber: Object
});

const tab = ref(null)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

const stats = [
    { name: 'Status', stat: props.course.status, previousStat: '' },
    { name: 'Member', stat: props.subscriber.length, previousStat: '' },
    { name: 'Owner', stat: props.course.user.name, previousStat: '' },
]
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
                    <a
                        class="text-primary-600 font-semibold mr-5"
                        target="_blank"
                        :href="route('landing.course.show', props.course)"
                    >
                        <i class="fa-duotone fa-arrow-up-right-from-square mr-1"></i>
                        Lihat
                    </a>
                    <PrimaryButton as="a" :href="route('course.edit', props.course)" >Ubah Data</PrimaryButton>
                </div>
            </div>

            <div>
                <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-300 dark:divide-gray-600 border border-gray-300 overflow-hidden rounded-3xl bg-white bg-opacity-50 shadow-lg md:grid-cols-3 md:divide-y-0 md:divide-x">
                    <div v-for="item in stats" :key="item.name" class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                {{ item.stat }}
                                <span class="ml-2 text-sm font-medium text-gray-500">{{ item.previousStat }}</span>
                            </div>
                        </dd>
                    </div>
                </dl>
            </div>

            <h1 class="mt-10 text-sm font-medium leading-6 text-gray-900">Total member {{ props.subscriber.length }}</h1>
            <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
                <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                    <template v-for="sub in props.subscriber">
                        <MemberList :member="sub" />
                    </template>
                </ul>
            </div>
        </div>


    </AppLayout>

</template>
