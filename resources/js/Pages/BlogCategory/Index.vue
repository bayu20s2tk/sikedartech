<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {ref} from "vue";

const props = defineProps({
    category: Object | String
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

const searchQueryCategory = ref('')
const gridTitleCategory = [
    'Nama',
    'Keterangan',
    'status'
]
const gridColumnsCategory = [
    'name',
    'desc',
    'status'
]

</script>

<template>
    <AppLayout title="Kategori Blog"
               name="Kategori Blog"
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
                <PrimaryButton as="a" :href="route('blogCategory.create')" >Tambah</PrimaryButton>
            </div>
        </div>

        <Table
            :title="gridTitle"
            :data="props.category.data"
            :paginate="props.category"
            :columns="gridColumns"
            :filter-key="searchQuery"
            routes="blogCategory"
            :slug=false
            :view=false
            :edit=true
        />

    </AppLayout>



</template>
