<script setup>
import {Link, router, useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import moment from "moment";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Heading from "@/Components/Heading.vue";
import Badge from "@/Components/Badge.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DialogModal from "@/Components/DialogModal.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";

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

const projectTab = ref(0)
const tab = ref(1)

const form = useForm({
    project_id: null,
    desc: null,
    price: null
});

const storeInformation = () => {
    console.log(form.desc)
    form.project_id = showForm

    form.post(route('projectBid.store', props.project), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            console.log('2')
        },
        onError: () => {
            console.log('3')
        },
        onFinish: () => {
            // form.reset()
            console.log('5')
            router.reload({only: ['project']})
        }
    });

    // router.reload({only: ['project']})
};

const showForm = ref(null);
const closeModal = () => {
    showForm.value = null;
    form.reset();
};

</script>

<template>
    <LandingLayout title="Course" desc="Lorem ipsum">

        <div class="pt-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 lg:items-start">
                <div class="px-4 sm:px-6 lg:px-0">
                    <Heading >
                        <template #header>
                            Proyek
                        </template>
                        <template #desc>
                            Lorem ipsum dolor sit amet
                        </template>
                    </Heading>
                </div>

                <div class="relative mx-auto grid lg:grid-cols-6 gap-10 px-4 sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="lg:col-span-2 ">
                        <div class="mt-3 bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                            <div class="px-3 py-5 grid gap-3 ">
                                <h3 class="font-semibold text-gray-900 ml-2">
                                    {{ props.project?.data.length ?? '0' }} Proyek
                                </h3>

                                <template v-for="(list, listIdx) in props.project?.data" :key="list.id">
                                    <button @click="projectTab=listIdx">
                                        <div
                                            class="rounded-3xl py-3 px-5 text-left "
                                            :class="projectTab==listIdx ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                        >
<!--                                                <i class="fa-solid fa-play mr-1"/>-->
                                            {{ list.name }}
                                        </div>
                                    </button>
                                </template>

                                <div v-if="props.project" class="px-4 py-0 grid items-center justify-center sm:px-6">
                                    <div class="my-3">
                                        <p class="text-sm text-gray-500">
                                            Menampilkan
                                            {{ ' ' }}
                                            <span class="font-medium">{{ props.project.from }}</span>
                                            {{ ' ' }}
                                            sampai
                                            {{ ' ' }}
                                            <span class="font-medium">{{ props.project.to }}</span>
                                            {{ ' ' }}
                                            dari
                                            {{ ' ' }}
                                            <span class="font-medium">{{ props.project.total }}</span>
                                            {{ ' ' }}
                                            hasil
                                        </p>
                                    </div>

                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <Link :href="props.project.prev_page_url ?? ''"
                                              class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-full shadow-lg text-gray-700 bg-white hover:bg-gray-50"> Previous </Link>
                                        <Link :href="props.project.next_page_url ?? ''"
                                              class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-full shadow-lg text-gray-700 bg-white hover:bg-gray-50"> Next </Link>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                                        <nav class="relative z-0 inline-flex -space-x-px" aria-label="Pagination">
                                            <template v-for="link in props.project.links">
                                                <Link
                                                    :href="link.url ?? '' "
                                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium rounded-full shadow-lg"
                                                    :class="link.active ? 'z-10 bg-primary-50 border-primary-500 text-primary-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 ' "
                                                >
                                                    <span v-html="link.label"></span>
                                                </Link>
                                            </template>
                                        </nav>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 py-3">
                        <template v-for="(item, itemIdx) in props.project?.data">
                            <div v-if="projectTab==itemIdx" class="">
                                <Badge :name="item.status" :class="item.color" />
                                <h3 class="mt-1 text-gray-900 font-semibold text-2xl" v-html="item.name" />
                                <p class="mt-1 mb-5 text-primary-500 font-semibold">
                                    <i class="fa-regular mr-1" :class="item.category.icon"/>
                                    {{ item.category.name }}
                                </p>

                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="item.desc" />

                                <div class="mt-10 py-10 px-10 bg-gray-200 bg-opacity-50 rounded-3xl border border-gray-300">
                                    <div class="grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2">
                                        <p>
                                            <span class="block text-xl font-bold text-gray-900">Rp {{ formatPrice(item.budget_from) }}</span>
                                            <span class="mt-1 block text-sm text-gray-600">
                                              <span class="font-medium text-gray-900">Published Budget</span> alalla
                                            </span>
                                        </p>

                                        <p>
                                            <span class="block text-xl font-bold text-gray-900">{{ formattedDate(item.created_at) }}</span>
                                            <span class="mt-1 block text-sm text-gray-600">
                                              <span class="font-medium text-gray-900">Published Date</span> alalla
                                            </span>
                                        </p>

                                        <p>
                                            <span class="block text-xl font-bold text-gray-900">{{ item.status }}</span>
                                            <span class="mt-1 block text-sm text-gray-600">
                                              <span class="font-medium text-gray-900">Project Status</span> alalla
                                            </span>
                                        </p>

                                        <p>
                                            <span class="block text-xl font-bold text-gray-900">{{ item.bid.length }}</span>
                                            <span class="mt-1 block text-sm text-gray-600">
                                              <span class="font-medium text-gray-900">Bid Count</span> alalla
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-10 grid gap-10">
                                    <div class="">
                                        <PrimaryButton @click="showForm=item.id" v-if="item.status_id==1">
                                            <i class="fa-duotone fa-paper-plane mr-2" />
                                            Place new bid
                                        </PrimaryButton>
                                    </div>

                                    <div class="space-y-8 sm:space-y-12">
                                        <ul role="list" class="mx-auto gap-x-4 gap-y-4 flex">
                                            <li v-for="bid in item.bid" :key="bid.id">
                                                <div class="space-y-4">
                                                    <img class="mx-auto h-10 w-10 rounded-full lg:h-16 lg:w-16" :src="bid.user.profile_photo_url" alt="" />
                                                    <div class="space-y-2">
                                                        <div class="text-center text-xs font-medium lg:text-sm">
                                                            <h3>{{ bid.user.name }}</h3>
<!--                                                            <p class="text-primary-600">{{ bid.user.email }}</p>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="mt-10 pt-10 border-t border-gray-300 flex justify-between items-start gap-10">
                                    <div class="flex items-center flex-none">
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
                        </template>
                    </div>

                </div>

            </div>
        </div>

        <DialogModal :show="showForm!=null" @close="closeModal">
            <template #title>
                Lorem ipsum dolor sit amet
            </template>

            <template #content>
                <div class="grid grid-cols-6 justify-between gap-5">
                    <div class="col-span-6 sm:col-span-6">
                        <InputLabel for="desc" value="Deskripsi"/>
                        <TextAreaInput
                            id="desc"
                            v-model="form.desc"
                            class="mt-1 block w-full"
                            rows="4"
                            required
                        />
                        <InputError :message="form.errors.desc" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <InputLabel for="price" value="Harga" />
                        <div class="flex">
                            <span class="flex items-center bg-white text-black border border-gray-300 border-r-0 rounded-3xl rounded-r-none shadow-sm mt-1 px-3 ">
                                Rp
                            </span>
                            <TextInput
                                id="price"
                                v-model="form.price"
                                type="number"
                                class="mt-1 block w-full rounded-l-none"
                                required
                            />
                        </div>
                        <InputError :message="form.errors.price" class="mt-2" />
                    </div>
                </div>

            </template>

            <template #footer>
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="storeInformation"
                >
                    Simpan
                </PrimaryButton>
            </template>
        </DialogModal>

    </LandingLayout>

</template>
