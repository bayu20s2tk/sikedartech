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
    project: undefined,
});

onMounted(() => {
    router.reload({only: ['project']})
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
    <AppLayout title="Proyek"
               name="Proyek"
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
                <PrimaryButton as="a" :href="route('project.create')" >Tambah</PrimaryButton>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item in props.project" :key="item.name">
                <div>
                    <Link :href="route('project.show', item)" class="inline-block">
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium"
                            :class="item.color"
                        >
                          {{ item.status }}
                        </span>
                    </Link>
                </div>
                <Link :href="route('project.show', item)" class="mt-4 block">
                    <p class="text-xl font-semibold text-gray-900">{{ item.name }}</p>
<!--                    <p class="mt-3 text-base text-gray-500">{{ blog.desc }}</p>-->
                </Link>

                <p class="mt-2 text-sm font-medium text-gray-500">
                    {{ item.bid.length }} Bid
                </p>

<!--                <div class="mt-6 flex items-center">-->
<!--                    <div class="flex-shrink-0">-->
<!--                        <Link :href="route('user.show', item.user)">-->
<!--                            <img class="h-10 w-10 rounded-full" :src="item.user.profile_photo_url" alt=""/>-->
<!--                        </Link>-->
<!--                    </div>-->
<!--                    <div class="ml-3">-->
<!--                        <p class="text-sm font-medium text-gray-900">-->
<!--                            <Link :href="route('user.show', item.user)">{{ item.user.name }}</Link>-->
<!--                        </p>-->
<!--                        <div class="flex space-x-1 text-sm text-gray-500">-->
<!--                            <time :datetime="formattedDate(item.created_at)">{{ formattedDate(item.created_at) }}</time>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
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
