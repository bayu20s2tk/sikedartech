<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import {ref, watch} from "vue";
import moment from "moment";
import Pagination from "../../Components/Pagination.vue";
import ComplaintList from "./Partials/ComplaintList.vue";
import TextInput from "../../Components/TextInput.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";

const props = defineProps({
    complaint: {
        type: Object,
        default: () => ({}),
    },
});

// let search = ref('');
// watch(search, (value) => {
//     router.get(
//         route('complaint.index'),
//         { search: value },
//         {
//             preserveState: true,
//             replace: true,
//         }
//     );
// });

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>
    <AppLayout title="Pengaduan"
               name="Pengaduan"
               desc="lorem ipsum"
               >

        <div class="flex justify-between gap-3">
            <div class="">
<!--                <TextInput-->
<!--                    type="text"-->
<!--                    v-model="search"-->
<!--                    placeholder="Cari disini"-->
<!--                    class="block w-full lg:w-96 mb-5 shadow"-->
<!--                />-->
            </div>

            <div class="">
<!--                <PrimaryButton as="a" :href="route('courseCategory.create')" >Tambah</PrimaryButton>-->
            </div>
        </div>

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <template v-for="item in props.complaint.data">
                    <ComplaintList :item="item" />
                </template>

            </ul>
        </div>

<!--        <Pagination :pagination="props.complaint" />-->

    </AppLayout>



</template>
