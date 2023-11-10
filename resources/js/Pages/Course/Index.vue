<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {onMounted, ref, watch} from "vue";
import moment from "moment/moment";
import MobileMenu from "@/Components/MobileMenu.vue";
import Pagination from "../../Components/Pagination.vue";
import Badge from "../../Components/Badge.vue";

const props = defineProps({
    course: {
        type: Object,
        default: () => ({}),
    },
});

let search = ref('');
watch(search, (value) => {
    router.get(
        route('course.index'),
        {search: value},
        {
            preserveState: true,
            replace: true,
        }
    );
});

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>
    <AppLayout title="Kelas"
               name="Kelas"
               desc="lorem ipsum"
    >

<!--        <div class="col-span-1 divide-y divide-gray-300 dark:divide-gray-600 rounded-3xl bg-white bg-opacity-50 shadow-lg border border-gray-300">-->
<!--            &lt;!&ndash;            <div class="flex w-full items-center justify-between space-x-6 p-6">&ndash;&gt;-->
<!--            &lt;!&ndash;                <div class="flex-1 truncate">&ndash;&gt;-->
<!--            &lt;!&ndash;                    <div class="flex items-center space-x-3">&ndash;&gt;-->
<!--            &lt;!&ndash;                        <h3 class="truncate text-sm font-medium text-gray-900">&ndash;&gt;-->
<!--            &lt;!&ndash;                            Bla bla&ndash;&gt;-->
<!--            &lt;!&ndash;                        </h3>&ndash;&gt;-->
<!--            &lt;!&ndash;                        <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">&ndash;&gt;-->
<!--            &lt;!&ndash;                            lorem ipsum&ndash;&gt;-->
<!--            &lt;!&ndash;                        </span>&ndash;&gt;-->
<!--            &lt;!&ndash;                    </div>&ndash;&gt;-->
<!--            &lt;!&ndash;                    <p class="mt-1 truncate text-sm text-gray-500">awww</p>&ndash;&gt;-->
<!--            &lt;!&ndash;                </div>&ndash;&gt;-->
<!--            &lt;!&ndash;            </div>&ndash;&gt;-->
<!--            <div>-->
<!--                <div class="-mt-px flex divide-x divide-gray-300 dark:divide-gray-600">-->
<!--                    <div class="flex w-0 flex-1">-->
<!--                        <div-->
<!--                            class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4">-->
<!--                            &lt;!&ndash;                            <i class="fa-duotone fa-down text-primary-400"/>&ndash;&gt;-->
<!--                            <div class="ml-3">-->
<!--                                <div class="text-xs text-gray-500">Saldo Masuk</div>-->
<!--                                <div class="text-sm font-medium text-gray-700">0</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="-ml-px flex w-0 flex-1">-->
<!--                        <div-->
<!--                            class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4">-->
<!--                            &lt;!&ndash;                            <i class="fa-duotone fa-up text-amber-400"/>&ndash;&gt;-->
<!--                            <div class="ml-3">-->
<!--                                <div class="text-xs text-gray-500">Riwayat Saldo</div>-->
<!--                                <div class="text-sm font-medium text-gray-700">0</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="flex justify-between gap-3">
            <div class="">
                <TextInput
                    type="text"
                    v-model="search"
                    placeholder="Cari disini"
                    class="block w-full lg:w-96 mb-5 shadow"
                />
            </div>

            <div class="" v-if="$page.props.user.role_id != 3">
                <PrimaryButton as="a" :href="route('course.create')">Tambah</PrimaryButton>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            <div v-for="item in props.course.data" :key="item.id">
                <Link
                    :href="$page.props.user.role_id !== 3 ? route('course.show', item) : route('landing.course.show', item)">
                    <div class="bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">
                        <div class="h-52 w-full overflow-hidden rounded-t-3xl relative">
                            <img :src="item.media[0]?.original_url" :alt="item.name"
                                 class="rounded-t-3xl h-full w-full object-cover object-center"/>
                            <div class="absolute inset-0">
                                <div class="flex justify-end p-3">
                                    <Badge :name="item.status" :class="item.color"/>
                                </div>
                            </div>
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

        <Pagination :pagination="props.course"/>

        <div class="mt-10">
            <p class="text-sm text-gray-900">Cari kelas baru untukmu
                <Link class="font-semibold text-primary-600 underline" :href="route('landing.course')">disini</Link>
            </p>
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
        <MobileMenu/>

    </AppLayout>


</template>
