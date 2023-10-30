<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {ref} from "vue";
import BillingList from "./Partials/BillingList.vue";

const props = defineProps({
    project: Object | String
});

const searchQuery = ref('')
const gridTitle = [
    'Nama',
    'Keterangan',
]
const gridColumns = [
    'name',
    'desc',
]

</script>

<template>
    <AppLayout title="Billing Proyek"
               name="Billing Proyek"
               desc="lorem ipsum"
               >

        <div class="flex justify-between gap-3">
            <div class="">
                <form id="search">
                    <TextInput
                        name="query"
                        v-model="searchQuery"
                        type="text"
                        class="block w-full lg:w-96 mb-5 shadow"
                        placeholder="Cari disini"
                    />
                </form>
            </div>

            <div class="">
<!--                <PrimaryButton as="a" :href="route('courseCategory.create')" >Tambah</PrimaryButton>-->
            </div>
        </div>

<!--        <Table-->
<!--            :title="gridTitle"-->
<!--            :data="props.subscribe.data"-->
<!--            :paginate="props.subscribe"-->
<!--            :columns="gridColumns"-->
<!--            :filter-key="searchQuery"-->
<!--            routes="courseSubscribe"-->
<!--            :slug=false-->
<!--            :view=false-->
<!--            :edit=false-->
<!--        />-->

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <template v-for="item in props.project">
                    <BillingList :item="item" />
                </template>

            </ul>
        </div>

    </AppLayout>



</template>
