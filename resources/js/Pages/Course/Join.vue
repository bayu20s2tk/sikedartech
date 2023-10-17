<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {Link, router, useForm} from "@inertiajs/vue3";
import 'vue3-carousel/dist/carousel.css'
import moment from "moment";
import Heading from "../../Components/Heading.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import { CheckIcon } from '@heroicons/vue/24/outline'
import BlankLayout from "../../Layouts/BlankLayout.vue";
import CourseLayout from "../../Layouts/CourseLayout.vue";
import DialogModal from "../../Components/DialogModal.vue";
import {ref} from "vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";

const props = defineProps({
    course: Object,
});

const form = useForm({
    course_id: props.course.id,
    desc: null,
    photo: null,
});

const storeInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    form.post(route('course.subscribe', props.course), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            clearPhotoFileInput()
        },
        // onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const showBill = ref(false);
const showForm = ref(false);

const photoPreview = ref(null);
const photoInput = ref(null);

const confirmBill = () => {
    showBill.value = true;
};

const confirmForm = () => {
    showForm.value = true;
}

const closeModal = () => {
    showBill.value = false;
    showForm.value = false;

    form.reset();
};
const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
}

</script>

<template>

    <CourseLayout :title="props.course.name">
        <div class="">
            <div class="relative overflow-hidden pt-32 pb-96 lg:pt-10">
                <div class="relative mx-auto max-w-7xl px-6 text-center lg:px-8">
                    <div class="mx-auto max-w-2xl lg:max-w-4xl">
                        <h2 class="text-lg font-semibold leading-8 text-primary-600">#kamubelumbayar</h2>
                        <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900">Lorem ipsum dolor</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600">Langkah yang tepat untuk berinvestasi kepada ilmu pengetahuan yang baru di bidang IT.</p>
                    </div>
                </div>
            </div>
            <div class="flow-root pb-32 lg:pb-40">
                <div class="relative -mt-80">
                    <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto grid max-w-md grid-cols-1 gap-8 lg:max-w-4xl lg:grid-cols-1 lg:gap-8">
                            <div class="flex flex-col rounded-3xl bg-white bg-opacity-50 shadow-xl border border-gray-300">
                                <div class="p-8 sm:p-10">
                                    <h3 class="text-lg font-semibold leading-8 tracking-tight text-primary-600" >{{ props.course.name }}</h3>
                                    <div class="mt-4 flex items-baseline text-5xl font-bold tracking-tight text-gray-900">
                                        Rp {{ formatPrice(props.course.price) }}
<!--                                        <span class="text-lg font-semibold leading-8 tracking-normal text-gray-500">/mo</span>-->
                                    </div>
                                    <p class="mt-6 text-base leading-7 text-gray-600">{{ props.course.desc }}</p>
                                </div>
                                <div class="flex flex-1 flex-col p-2">
                                    <div class="flex flex-1 flex-col justify-between rounded-3xl bg-gray-100 p-6 sm:p-8">
                                        <ul role="list" class="space-y-6">
                                            <li class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <CheckIcon class="h-6 w-6 text-primary-600" aria-hidden="true" />
                                                </div>
                                                <p class="ml-3 text-sm leading-6 text-gray-600">Sekali bayar saja</p>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <CheckIcon class="h-6 w-6 text-primary-600" aria-hidden="true" />
                                                </div>
                                                <p class="ml-3 text-sm leading-6 text-gray-600">Akses kelas selamanya</p>
                                            </li>
                                            <li class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <CheckIcon class="h-6 w-6 text-primary-600" aria-hidden="true" />
                                                </div>
                                                <p class="ml-3 text-sm leading-6 text-gray-600">Materi belajar terbaru</p>
                                            </li>
                                        </ul>
                                        <div class="mt-8">
                                            <PrimaryButton
                                                class="w-full justify-center"
                                                @click="confirmBill"
                                            >
                                                Mulai Belajar
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative mx-auto mt-8 max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-md lg:max-w-4xl">
                        <div class="flex flex-col gap-6 rounded-3xl p-8 border border-gray-300 sm:p-10 lg:flex-row lg:items-center lg:gap-8">
                            <div class="lg:min-w-0 lg:flex-1">
                                <h3 class="text-lg font-semibold leading-8 tracking-tight text-primary-600">Sudah bayar?</h3>
                                <div class="mt-2 text-base leading-7 text-gray-600">Lorem ipsum dolor sit amet <span class="font-semibold text-gray-900">Rp {{ formatPrice(props.course.price) }}</span>.</div>
                            </div>
                            <div>
                                <button
                                    class="inline-block rounded-3xl bg-primary-50 px-4 py-2.5 text-center text-sm font-semibold leading-5 text-primary-700 hover:bg-primary-100"
                                    @click="confirmForm"
                                >
                                    Isi form bukti pembayaran <span aria-hidden="true">&rarr;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="showBill" @close="closeModal">
            <template #title>
                Lorem ipsum dolor sit amet
            </template>

            <template #content>
                <div class="flex justify-center p-5 mb-5 border-b border-gray-300">
                    <img src="/img/vendor/PERMATA.svg" class="w-52" />
                </div>
                <div class="grid grid-cols-2 justify-between gap-2">
                    <div class="">
                        Jumlah Transfer
                    </div>
                    <div class="text-right font-medium">
                       Rp {{ formatPrice(props.course.price) }}
                    </div>

                    <div class="">
                        Berita Transfer
                    </div>
                    <div class="text-right font-medium">
                        {{ $page.props.user.name }}
                    </div>

                    <div class="">
                        Nomor Rekening
                    </div>
                    <div class="text-right font-medium">
                        0808080808
                    </div>

                    <div class="">
                        Nama Rekening
                    </div>
                    <div class="text-right font-medium">
                        Sikedar Tech
                    </div>

                </div>

                <div class="bg-amber-50 border border-gray-300 rounded-3xl p-2 mt-2">
                    Mohon untuk transfer sesuai dengan jumlah yang tertera.
                </div>
            </template>

        </DialogModal>

        <DialogModal :show="showForm" @close="closeModal">
            <template #title>
                Lorem ipsum dolor sit amet
            </template>

            <template #content>
                <div class="flex justify-center p-5 mb-5 border-b border-gray-300">
                    <img src="/img/vendor/PERMATA.svg" class="w-52" />
                </div>
                <div class="grid grid-cols-6 justify-between gap-5">
                    <div class="col-span-6 sm:col-span-4">
                        <!-- Profile Photo File Input -->
                        <input
                            ref="photoInput"
                            type="file"
                            class="hidden"
                            @change="updatePhotoPreview"
                        >
                        <InputLabel for="photo" value="Foto" />

                        <!-- Current Profile Photo -->
<!--                        <div v-show="! photoPreview" class="mt-2">-->
<!--                            <template v-if="props.setting?.media !=null">-->
<!--                                <img :src="props.setting.media[0].original_url" :alt="setting.name" class="rounded-full h-20 w-20 object-cover">-->
<!--                            </template>-->
<!--                        </div>-->

                        <!-- New Profile Photo Preview -->
                        <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-3xl w-40 h-40 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                        </div>

                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            Foto bukti transfer
                        </SecondaryButton>

                        <InputError :message="form.errors.photo" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-6">
                        <InputLabel for="name" value="Keterangan"/>
                        <TextInput
                            id="name"
                            v-model="form.desc"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="name"
                            required
                        />
                        <InputError :message="form.errors.desc" class="mt-2"/>
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


    </CourseLayout>

</template>
