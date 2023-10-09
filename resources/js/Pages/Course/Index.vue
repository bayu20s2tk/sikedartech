<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {onMounted, ref} from "vue";
import moment from "moment/moment";

const props = defineProps({
    course: undefined,
});

onMounted(() => {
    router.reload({only: ['course']})
})

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

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
    <AppLayout title="Kelas"
               name="Kelas"
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

        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item in props.course" :key="item.id">
                <Link :href="route('course.edit', item)">
                    <div class="bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">
                        <div class="h-52 w-full overflow-hidden rounded-t-3xl">
                            <img :src="item.media[0]?.original_url" :alt="item.name"
                                 class="rounded-t-3xl h-full w-full object-cover object-center"/>
                        </div>
                        <div class="py-3 px-5 items-end">
                            <h3 class="text-lg font-semibold text-gray-900">{{ item.name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ item.desc }}</p>
                            <p class="mt-1 text-sm font-semibold text-gray-700">Rp {{ formatPrice(item.price) }}</p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>

<!--        <Table-->
<!--            :title="gridTitle"-->
<!--            :data="props.course.data"-->
<!--            :paginate="props.course"-->
<!--            :columns="gridColumns"-->
<!--            :filter-key="searchQuery"-->
<!--            routes="course"-->
<!--            :slug=true-->
<!--            :view=true-->
<!--            :edit=true-->
<!--        />-->

    </AppLayout>



</template>
