<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {ref} from "vue";

const props = defineProps({
    course: Object | String,
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
    <AppLayout title="Kursus"
               name="Kursus"
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
                <PrimaryButton as="a" :href="route('course.create')" >Tambah</PrimaryButton>
            </div>
        </div>

        <Table
            :title="gridTitle"
            :data="props.course.data"
            :paginate="props.course"
            :columns="gridColumns"
            :filter-key="searchQuery"
            routes="course"
            :slug=true
            :view=true
            :edit=true
        />

    </AppLayout>



</template>
