<script setup>
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Table from "@/Components/Table.vue";
import {onMounted, ref, watch} from "vue";
import moment from "moment/moment";
import Heading from "../../Components/Heading.vue";
import Badge from "../../Components/Badge.vue";
import MobileMenu from "@/Components/MobileMenu.vue";
import Pagination from "../../Components/Pagination.vue";

const props = defineProps({
    project: {
        type: Object,
        default: () => ({}),
    },
    projectMe: {
        type: Object,
        default: () => ({}),
    }
});

// onMounted(() => {
//     router.reload({only: ['project', 'projectMe']})
// })

let search = ref('');
watch(search, (value) => {
    router.get(
        route('project.index'),
        { search: value },
        {
            preserveState: true,
        }
    );
});

let searchMe = ref('');
watch(searchMe, (value) => {
    router.get(
        route('project.index'),
        { searchMe: value },
        {
            preserveState: true,
        }
    );
});

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

const tabProject = ref(JSON.parse(localStorage.getItem('tabProject')) ?? 1)

watch(tabProject, (newTabProject) => {
    console.log(`tab is ${newTabProject}`)
    localStorage.setItem('tabProject', JSON.stringify(newTabProject))
})

</script>

<template>
    <AppLayout title="Proyek"
               name="Proyek"
               desc="lorem ipsum"
               >

        <div class="col-span-1 divide-y divide-gray-300 dark:divide-gray-600 rounded-3xl bg-white bg-opacity-50 shadow-lg border border-gray-300">
            <div class="flex w-full items-center justify-between space-x-6 p-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="truncate text-sm font-medium text-gray-900">
                            Bla bla
                        </h3>
                        <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                            lorem ipsum
                        </span>
                    </div>
                    <p class="mt-1 truncate text-sm text-gray-500">awww</p>
                </div>
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-300 dark:divide-gray-600">
                    <div class="flex w-0 flex-1">
                        <div class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4">
                            <i class="fa-duotone fa-down text-primary-400"/>
                            <div class="ml-3">
                                <div class="text-xs text-gray-500">Lorem ipsum</div>
                                <div class="text-sm font-medium text-gray-700">Dolor sit amet</div>
                            </div>
                        </div>
                    </div>
                    <div class="-ml-px flex w-0 flex-1">
                        <div class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4">
                            <i class="fa-duotone fa-up text-amber-400"/>
                            <div class="ml-3">
                                <div class="text-xs text-gray-500">Lorem ipsum</div>
                                <div class="text-sm font-medium text-gray-700">Dolor sit amet</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky top-0 z-40 backdrop-blur border-b border-gray-200">
            <nav class="-mb-px flex" aria-label="Tabs">

                <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                        :class="tabProject==1 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                        @click="tabProject=1"
                >
                    {{ $page.props.user.role_id==1 ? 'Semua Project' : 'Project for me' }} <Badge class="ml-1 bg-primary-600 text-white" :name="props.project?.data.length ?? 0" />
                </button>

                <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                        :class="tabProject==2 ? 'border-green-600 text-green-600' : 'text-gray-500 border-gray-300 ' "
                        @click="tabProject=2"
                >
                    Project by me <Badge class="ml-1 bg-green-600 text-white" :name="props.projectMe?.data.length ?? 0" />
                </button>
            </nav>
        </div>

        <div v-if="tabProject==1" class="">
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
<!--                    <PrimaryButton as="a" :href="route('project.create')" >Tambah</PrimaryButton>-->
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="item in props.project.data" :key="item.name">
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
                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0">
                            <Link :href="route('user.show', item.user)">
                                <img class="h-10 w-10 rounded-full" :src="item.user.profile_photo_url" alt=""/>
                            </Link>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <Link :href="route('user.show', item.user)">{{ item.user.name }}</Link>
                            </p>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <time :datetime="formattedDate(item.created_at)">{{ formattedDate(item.created_at) }}</time>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <Pagination :pagination="props.project" />

            <div class="mt-10">
                <p class="text-sm text-gray-900">Cari proyek baru untukmu <Link class="font-semibold text-primary-600 underline" :href="route('landing.project')">disini</Link></p>
            </div>
        </div>

        <div v-if="tabProject==2" class="">
            <div class="flex justify-between gap-3">
                <div class="">
                    <TextInput
                        type="text"
                        v-model="searchMe"
                        placeholder="Cari disini"
                        class="block w-full lg:w-96 mb-5 shadow"
                    />
                </div>

                <div class="">
                    <PrimaryButton as="a" :href="route('project.create')" >Tambah</PrimaryButton>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="item in props.projectMe.data" :key="item.name">
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

<!--                    <div class="mt-2 text-sm font-medium text-gray-500">-->
<!--                        <p>{{ item.bid.price }}</p>-->
<!--                        <p>{{ item.bid.length }} Bid</p>-->
<!--                    </div>-->

                    <div class="mt-6 flex items-center">
                        <div class="flex-shrink-0">
                            <Link :href="route('user.show', item.user)">
                                <img class="h-10 w-10 rounded-full" :src="item.user.profile_photo_url" alt=""/>
                            </Link>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                <Link :href="route('user.show', item.user)">{{ item.user.name }}</Link>
                            </p>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <time :datetime="formattedDate(item.created_at)">{{ formattedDate(item.created_at) }}</time>
                            </div>
                        </div>
                    </div>
                </div>
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
        <MobileMenu />

    </AppLayout>



</template>
