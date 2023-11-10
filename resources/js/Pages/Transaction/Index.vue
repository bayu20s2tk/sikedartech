<script setup>
import {onMounted, onUnmounted, ref, watch} from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, useForm, router} from "@inertiajs/vue3";
import MobileMenu from "@/Components/MobileMenu.vue";
import moment from "moment";
import { Vue3Lottie } from 'vue3-lottie'
import Badge from "../../Components/Badge.vue";
import Pagination from "../../Components/Pagination.vue";

const props = defineProps({
    course: {
        type: Object,
        default: () => ({}),
    },
    project: {
        type: Object,
        default: () => ({}),
    },
    // in_count: undefined,
    // out_count: undefined,
    // on_process: undefined,
    // all_process: undefined
})

// onMounted(() => {
//     console.log('transaction');
//     router.reload({ only: ['transaction', 'in_count', 'out_count', 'on_process', 'all_process'] })
// })
//
// onUnmounted(() => {
//     clearInterval(interval)
// })
//
// const interval = setInterval(() => {
//     console.log('interval');
//     router.reload({ only: ['transaction', 'in_count', 'out_count', 'on_process', 'all_process'] })
// }, 10000)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

const tabTransaction = ref(JSON.parse(localStorage.getItem('tabTransaction')) ?? 1)

watch(tabTransaction, (newTabTransaction) => {
    console.log(`tab is ${newTabTransaction}`)
    localStorage.setItem('tabTransaction', JSON.stringify(newTabTransaction))
})

</script>

<template>
    <AppLayout title="Riwayat Transaksi"
               name="Riwayat Transaksi"
               desc="Lorem ipsum dolor sit amet"
    >

<!--        <div class="col-span-1 divide-y divide-gray-300 dark:divide-gray-600 rounded-3xl bg-white bg-opacity-50 shadow-lg border border-gray-300">-->
<!--&lt;!&ndash;            <div class="flex w-full items-center justify-between space-x-6 p-6">&ndash;&gt;-->
<!--&lt;!&ndash;                <div class="flex-1 truncate">&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="flex items-center space-x-3">&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 class="truncate text-sm font-medium text-gray-900">&ndash;&gt;-->
<!--&lt;!&ndash;                            Bla bla&ndash;&gt;-->
<!--&lt;!&ndash;                        </h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">&ndash;&gt;-->
<!--&lt;!&ndash;                            lorem ipsum&ndash;&gt;-->
<!--&lt;!&ndash;                        </span>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <p class="mt-1 truncate text-sm text-gray-500">awww</p>&ndash;&gt;-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--            <div>-->
<!--                <div class="-mt-px flex divide-x divide-gray-300 dark:divide-gray-600">-->
<!--                    <div class="flex w-0 flex-1">-->
<!--                        <div class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4">-->
<!--                            <i class="fa-duotone fa-down text-primary-400"/>-->
<!--                            <div class="ml-3">-->
<!--                                <div class="text-xs text-gray-500">Uang masuk</div>-->
<!--&lt;!&ndash;                                <div class="text-sm font-medium text-gray-700">Rp {{ formatPrice(props.in_count ?? 0) }}</div>&ndash;&gt;-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="-ml-px flex w-0 flex-1">-->
<!--                        <div class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4">-->
<!--                            <i class="fa-duotone fa-up text-amber-400"/>-->
<!--                            <div class="ml-3">-->
<!--                                <div class="text-xs text-gray-500">Uang Keluar</div>-->
<!--&lt;!&ndash;                                <div class="text-sm font-medium text-gray-700">Rp {{ formatPrice(props.out_count ?? 0) }}</div>&ndash;&gt;-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="sticky top-0 z-40 backdrop-blur border-b border-gray-200">
            <nav class="-mb-px flex" aria-label="Tabs">
                <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                        :class="tabTransaction==1 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                        @click="tabTransaction=1"
                >
                    Kelas
<!--                    <Badge class="ml-1 bg-primary-600 text-white" :name="props.on_process ?? 0" />-->
                </button>

                <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                        :class="tabTransaction==2 ? 'border-green-600 text-green-600' : 'text-gray-500 border-gray-300 ' "
                        @click="tabTransaction=2"
                >
                    Proyek
<!--                    <Badge class="ml-1 bg-green-600 text-white" :name="props.all_process ?? 0" />-->
                </button>
            </nav>
        </div>

        <template v-if="tabTransaction==1">
            <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl overflow-hidden shadow-lg border border-gray-300">
                <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                    <template v-for="course in props.course.data" :key="course.id">
                        <li>
                            <div class="block hover:bg-primary-50" >
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium truncate uppercase text-primary-600">
                                            {{ course.name }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full "
                                               :class="course.color"
                                            >
                                                {{ course.status }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex">
                                            <p class="flex items-center text-sm text-gray-900">
                                                Rp {{ formatPrice(course.price) }}
                                                <template v-if="course.user_id==$page.props.user.id">
                                                    x {{ course.member.length }} = Rp {{ formatPrice(Number(course.price) * Number(course.member.length)) }}
                                                </template>
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-2">
                                                <!--                                            <i class="fa-regular fa-down-to-bracket text-gray-500 pr-2" />-->
                                            </p>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-900" >
                                            {{ course.user_id==$page.props.user.id ? 'Owner' : 'Peserta' }}
                                            <!--                                            <i class="fa-regular fa-calendar pr-2" />-->
                                            <!--                                            {{ formattedDate(transaction.created_at) }}-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <Pagination :pagination="props.course" />
        </template>

        <template v-if="tabTransaction==2">
            <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl overflow-hidden shadow-lg border border-gray-300">
                <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                    <template v-for="project in props.project.data" :key="project.id">
                        <li>
                            <div class="block hover:bg-primary-50" >
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="font-medium truncate uppercase text-primary-600">
                                            {{ project.name }}
                                        </p>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full "
                                               :class="project.color"
                                            >
                                                {{ project.status }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex">
                                            <p class="flex items-center text-sm text-gray-900">
                                                Rp {{ formatPrice(project.price) }}
                                            </p>
                                            <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-2">
                                                <!--                                            <i class="fa-regular fa-down-to-bracket text-gray-500 pr-2" />-->
                                            </p>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-900" >
                                            {{ project.user_id==$page.props.user.id ? 'Owner' : 'Worker' }}
                                            <!--                                            <i class="fa-regular fa-calendar pr-2" />-->
                                            <!--                                            {{ formattedDate(transaction.created_at) }}-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <Pagination :pagination="props.project" />
        </template>


        <MobileMenu/>
    </AppLayout>
</template>
