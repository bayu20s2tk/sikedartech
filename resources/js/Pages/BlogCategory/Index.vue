<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {ref, watch} from "vue";
import moment from "moment/moment";
import Pagination from "../../Components/Pagination.vue";

const props = defineProps({
    category: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref('');
watch(search, (value) => {
    router.get(
        route('blogCategory.index'),
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

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
                        type="text"
                        v-model="search"
                        placeholder="Cari disini"
                        class="block w-full lg:w-96 mb-5 shadow"
                    />
                </form>
            </div>

            <div class="">
                <PrimaryButton as="a" :href="route('blogCategory.create')" >Tambah</PrimaryButton>
            </div>
        </div>

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl overflow-hidden shadow-lg border border-gray-300">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <template v-for="item in props.category.data" :key="item.id">
                    <li>
                        <Link preserve-scroll :href="route('blogCategory.edit', item)" class="flex items-center hover:bg-primary-50" >
                            <div class="pl-4 sm:pl-6">
                                <i class="fa-duotone text-primary-600 text-2xl" :class="item.icon" />
                            </div>
                            <div class="px-4 py-4 sm:px-6 grow">
                                <div class="flex items-center justify-between">
                                    <p class="font-medium truncate capitalize text-gray-900">
                                        {{ item.name }}
                                    </p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-gray-900">
                                            {{ item.status }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex">
                                        <p class="flex items-center text-sm text-gray-600" >
                                            {{ item.desc }}
                                        </p>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600" >
                                        <!--                                        <i class="fa-regular fa-calendar pr-2" />-->
                                        {{ formattedDate(item.updated_at) }}
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </li>
                </template>
            </ul>
        </div>

        <Pagination :pagination="props.category" />

    </AppLayout>



</template>
