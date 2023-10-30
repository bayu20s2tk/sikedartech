<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {onMounted, ref} from "vue";
import moment from "moment/moment";
import MobileMenu from "@/Components/MobileMenu.vue";

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

            <div class="" v-if="$page.props.user.role_id != 3">
                <PrimaryButton as="a" :href="route('course.create')" >Tambah</PrimaryButton>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item in props.course" :key="item.id">
                <Link :href="$page.props.user.role_id !== 3 ? route('course.show', item) : route('landing.course.show', item)">
                    <div class="bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">
                        <div class="h-52 w-full overflow-hidden rounded-t-3xl">
                            <img :src="item.media[0]?.original_url" :alt="item.name"
                                 class="rounded-t-3xl h-full w-full object-cover object-center"/>
                        </div>
                        <div class="py-3 px-5 items-end">
                            <h3 class="text-lg font-semibold text-gray-900">{{ item.name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ item.desc }}</p>
<!--                            <p class="mt-1 text-sm font-semibold text-gray-700">-->
<!--                                <template v-if="item.has_subscribed">-->
<!--                                    <i class="fa-duotone fa-circle-check text-green-600 mr-1" /> Akses selamanya-->
<!--                                </template>-->
<!--                                <template v-else>-->
<!--                                    Rp {{ formatPrice(item.price) }}-->
<!--                                </template>-->
<!--                            </p>-->
                        </div>
                    </div>
                </Link>
            </div>
        </div>

        <div class="mt-10">
            <p class="text-sm text-gray-900">Cari kelas baru untukmu <Link class="font-semibold text-primary-600 underline" :href="route('landing.course')">disini</Link></p>
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
        <MobileMenu />

    </AppLayout>



</template>
