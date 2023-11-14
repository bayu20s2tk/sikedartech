<script setup>
import {onMounted, onUnmounted, ref, watch} from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, useForm, router} from "@inertiajs/vue3";
import MobileMenu from "@/Components/MobileMenu.vue";
import moment from "moment";
import {Vue3Lottie} from 'vue3-lottie'
import Badge from "../../Components/Badge.vue";
import Pagination from "../../Components/Pagination.vue";
import BillingList from "../ProjectBilling/Partials/BillingList.vue";
import TextInput from "../../Components/TextInput.vue";
import WdList from "./Partials/WdList.vue";

const props = defineProps({
    wd: {
        type: Object,
        default: () => ({}),
    },
})

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    let val = (value / 1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

const tabWd = ref(JSON.parse(localStorage.getItem('tabWd')) ?? 1)

watch(tabWd, (newTabWd) => {
    console.log(`tab is ${newTabWd}`)
    localStorage.setItem('tabWd', JSON.stringify(newTabWd))
})

let search = ref('');
watch(search, (value) => {
    router.get(
        route('withdraw.index'),
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

</script>

<template>
    <AppLayout title="Withdraw"
               name="Withdraw"
               desc="Lorem ipsum dolor sit amet"
    >

        <div class="flex justify-between gap-3">
            <div class="">
                <TextInput
                    type="text"
                    v-model="search"
                    placeholder="Cari disini"
                    class="block w-full lg:w-96 mb-5 shadow"
                />
            </div>

            <div class="">
                <!--                <PrimaryButton as="a" :href="route('courseCategory.create')" >Tambah</PrimaryButton>-->
            </div>
        </div>

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <template v-for="item in props.wd.data">
                    <WdList :item="item" />
                </template>

            </ul>
        </div>

        <Pagination :pagination="props.wd"/>

        <MobileMenu/>
    </AppLayout>
</template>
