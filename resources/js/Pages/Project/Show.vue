<script setup>
import {Link, router} from "@inertiajs/vue3";
import {onMounted, onUnmounted, ref, watch} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Heading from "@/Components/Heading.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PreviousButton from "../../Components/PreviousButton.vue";
import Badge from "../../Components/Badge.vue";
import BidList from "./Partials/BidList.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import ChatSection from "./Partials/ChatSection.vue";
import MediaSection from "./Partials/MediaSection.vue";
import DangerButton from "../../Components/DangerButton.vue";
import ProgressSection from "./Partials/ProgressSection.vue";
import SummarySection from "./Partials/SummarySection.vue";
import PaymentModal from "./Partials/PaymentModal.vue";
import WorkerAlert from "./Partials/WorkerAlert.vue";

const props = defineProps({
    project: Object,
    chat: Object
});

const form = useForm({
    status_id: null,
    deadline_date: null,
});

const storeInformation = (id) => {

    if (props.project.status_id == 2) {
        // form.status_id = 3
        form.deadline_date = moment().add(props.project.finish_day, 'days').format();
    }

    form.status_id = id

    form.patch(route('project.update', props.project), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
    });
};

const cancelInformation = () => {
    form.status_id = 0

    form.patch(route('project.update', props.project), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
    });
};

const tab = ref(null)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

const tabProjectShow = ref(1)

// const tabProjectShow = ref(JSON.parse(localStorage.getItem('tabProjectShow')) ?? 1)

// watch(tabProjectShow, (newTabProjectShow) => {
//     console.log(`tab is ${newTabProjectShow}`)
//     localStorage.setItem('tabProjectShow', JSON.stringify(newTabProjectShow))
// })

const paymentModal = ref(false)
</script>

<template>
    <AppLayout
        title="Proyek"
        name="Proyek"
        desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton/>
        </template>

        <div class="max-w-7xl mx-auto items-start">
            <div class="flex justify-between gap-3">
                <div class="">
                    <h1 class="text-xl font-medium leading-6 text-gray-900">{{ props.project.name }}</h1>
                </div>

                <div class="flex items-center gap-2">
                    <template v-if="props.project.user_id==$page.props.user.id">
                        <DangerButton
                            v-if="props.project.status_id==0 || props.project.status_id==1"
                            @click="cancelInformation"
                        >
                            Cancel
                        </DangerButton>
                        <PrimaryButton
                            v-if="props.project.status_id==0 || props.project.status_id==1"
                            as="a"
                            :href="route('project.edit', props.project)"
                        >
                            Ubah Data
                        </PrimaryButton>
<!--                        <PrimaryButton-->
<!--                            v-if="props.project.status_id==2"-->
<!--                            @click="storeInformation(3)"-->
<!--                        >-->
<!--                            <i class="fa-duotone fa-paper-plane mr-2"/>-->
<!--                            Mulai Proyek-->
<!--                        </PrimaryButton>-->
                        <PrimaryButton
                            v-if="props.project.status_id==3"
                            @click="storeInformation(4)"
                        >
                            <i class="fa-duotone fa-check mr-2"/>
                            Proyek Selesai
                        </PrimaryButton>
                    </template>

                    <template v-if="$page.props.user.role_id==1">
                        <!--            <DangerButton-->
                        <!--                @click="cancelInformation"-->
                        <!--            >-->
                        <!--              Cancel-->
                        <!--            </DangerButton>-->
                        <PrimaryButton
                            v-if="props.project.status_id==0"
                            @click="storeInformation(1)"
                        >
                            <i class="fa-duotone fa-paper-plane mr-2"/>
                            Approve
                        </PrimaryButton>
                    </template>
                </div>
            </div>

            <div>
                <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-300 dark:divide-gray-600 border border-gray-300 overflow-hidden rounded-3xl bg-white bg-opacity-50 shadow-lg md:grid-cols-4 md:divide-y-0 md:divide-x">
                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">Status</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                {{ props.project.status }}
                                <span class="ml-2 text-sm font-medium text-gray-500"></span>
                            </div>
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">Deadline</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                {{ props.project.finish_day }} Hari
                                <span class="ml-2 text-sm font-medium text-gray-500">
                    / {{ formattedDate(props.project?.deadline_date) }}
                </span>
                            </div>
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">Worker</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                <Link v-if="props.project.worker" :href="route('user.show', props.project.worker)">
                                    {{ props.project.worker?.name }}
                                </Link>
                                <span v-else> - </span>
                                <span class="ml-2 text-sm font-medium text-gray-500"></span>
                            </div>
                        </dd>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">Owner</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                <Link :href="route('user.show', props.project.user)">
                                    {{ props.project.user?.name }}
                                </Link>
                                <span class="ml-2 text-sm font-medium text-gray-500"></span>
                            </div>
                        </dd>
                    </div>
                </dl>
            </div>

            <PaymentModal
                v-if="props.project.status_id==2 && props.project.user.id==$page.props.user.id"
                :project="props.project"
            />

            <WorkerAlert v-if="props.project.status_id==2 && props.project.worker?.id==$page.props.user.id" />

            <template v-if="props.project.status_id==0">
                <SummarySection
                    class="mt-10"
                    :project="props.project"
                />
            </template>

            <template v-else-if="props.project.status_id==1">
                <h1 class="mt-10 text-sm font-medium leading-6 text-gray-900">Total bids {{
                        props.project.bid.length
                    }}</h1>
                <div
                    class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
                    <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                        <template v-for="bid in props.project.bid">
                            <BidList :bid="bid"/>
                        </template>
                    </ul>
                </div>
            </template>

            <div v-else class="my-10">
                <div class="sticky top-0 z-40 backdrop-blur border-b border-gray-200 mb-10">
                    <nav class="-mb-px flex" aria-label="Tabs">

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==1 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                                @click="tabProjectShow=1"
                        >
                            Ringkasan
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==2 ? 'border-cyan-600 text-cyan-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabProjectShow=2"
                        >
                            Resources
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==3 ? 'border-green-600 text-green-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabProjectShow=3"
                        >
                            Conversation
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabProjectShow==4 ? 'border-sky-600 text-sky-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabProjectShow=4"
                                v-if="props.project.status_id!=2"
                        >
                            Progress
                        </button>
                    </nav>
                </div>

                <SummarySection
                    v-if="tabProjectShow==1"
                    :project="props.project"
                />

                <!--            <template v-else-if="tabProjectShow==2">-->
                <!--                <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">-->
                <!--                    <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">-->
                <!--                        <template v-for="bid in props.project.bid">-->
                <!--                            <BidList :bid="bid" />-->
                <!--                        </template>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--            </template>-->

                <MediaSection
                    v-else-if="tabProjectShow==2"
                    :project="props.project"
                />

                <ChatSection
                    v-else-if="tabProjectShow==3"
                    :project="props.project"
                    :chat="props.chat"
                />

                <ProgressSection
                    v-else-if="tabProjectShow==4"
                    :project="props.project"
                />

            </div>


        </div>
    </AppLayout>

</template>
