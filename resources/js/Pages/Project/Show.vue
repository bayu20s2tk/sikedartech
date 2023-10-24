<script setup>
import {Link} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Heading from "@/Components/Heading.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PreviousButton from "../../Components/PreviousButton.vue";
import Badge from "../../Components/Badge.vue";
import BidList from "./Partials/BidList.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";

const props = defineProps({
    project: Object,
});

const tab = ref(null)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

const tabProjectShow = ref(JSON.parse(localStorage.getItem('tabProjectShow')) ?? 1)

watch(tabProjectShow, (newTabProjectShow) => {
    console.log(`tab is ${newTabProjectShow}`)
    localStorage.setItem('tabProjectShow', JSON.stringify(newTabProjectShow))
})

</script>

<template>
    <AppLayout
        title="Proyek"
        name="Proyek"
        desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton />
        </template>

        <div class="max-w-7xl mx-auto items-start">
            <div class="flex justify-between gap-3">
                <div class="">
                    <h1 class="text-xl font-medium leading-6 text-gray-900">{{ props.project.name }}</h1>
                </div>

                <div class="">
                    <PrimaryButton v-if="props.project.status_id==1" as="a" :href="route('project.edit', props.project)" >Ubah Data</PrimaryButton>
                    <PrimaryButton v-else-if="props.project.status_id==2" class="mr-2" ><i class="fa-duotone fa-paper-plane mr-2" /> Mulai Proyek</PrimaryButton>
                </div>
            </div>

            <div>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-5">
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{ props.project.status }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Total Bid</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900">{{ props.project.bid.length }}</dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Deadline</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 flex items-center">
                            {{ props.project.finish_day }} Hari
                        </dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Worker</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 flex items-center">
                            <template v-if="props.project.worker">
<!--                                <img :src="props.project.worker.profile_photo_url" class="h-10 w-10 rounded-full object-cover mr-2" />-->
                                {{ props.project.worker.name }}
                            </template>
                            <template v-else>
                                Belum ada
                            </template>
                        </dd>
                    </div>
                    <div class="overflow-hidden rounded-3xl bg-white bg-opacity-50 px-4 py-5 shadow-lg border border-gray-300">
                        <dt class="truncate text-sm font-medium text-gray-500">Author</dt>
                        <dd class="mt-1 text-xl font-semibold tracking-tight text-gray-900 flex items-center">
<!--                            <img :src="props.project.user.profile_photo_url" class="h-10 w-10 rounded-full object-cover mr-2" />-->
                            {{ props.project.user.name }}
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="my-10">
                <div class="sticky top-0 z-40 backdrop-blur border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==1 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                                @click="tabProjectShow=1"
                        >
                            Ringkasan
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==2 ? 'border-green-600 text-green-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabProjectShow=2"
                        >
                            Bidder
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==3 ? 'border-green-600 text-green-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabProjectShow=3"
                        >
                            Progress
                        </button>
                    </nav>
                </div>
            </div>

            <template v-if="tabProjectShow==1">
                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="props.project.desc" />
            </template>

            <template v-else-if="tabProjectShow==2">
                <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
                    <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                        <template v-for="bid in props.project.bid">
                            <BidList :bid="bid" />
                        </template>
                    </ul>
                </div>
            </template>


        </div>


    </AppLayout>

</template>
