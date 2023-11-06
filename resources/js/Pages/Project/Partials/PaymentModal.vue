<script setup>
import DialogModal from "../../../Components/DialogModal.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import SecondaryButton from "../../../Components/SecondaryButton.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import InputError from "../../../Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import moment from "moment/moment";


const props = defineProps({
    project: Object,
    modelValue: String | Number,
    // showBill: {
    //     type: Boolean,
    //     default: false
    // }
});

// defineProps({
//     modelValue: String | Number,
// });

defineEmits(['update:modelValue']);

const form = useForm({
    project_id: props.project.id,
    photo: null,
});

const storeInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    form.post(route('projectSubscribe.store', props.project), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            clearPhotoFileInput()
        },
        // onError: () => passwordInput.value.focus(),
        onFinish: () => {
            form.reset()
            photoPreview.value=null
        }
    });
};

// onMounted(() => {
//     showBill.value=true
// })

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
    photoPreview.value = null;
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
    <div class="rounded-3xl bg-yellow-50 p-4 mt-10">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fa-regular fa-exclamation-triangle text-yellow-700" />
            </div>
            <div class="ml-3 w-full">
                <h3 class="text-sm font-medium text-yellow-800">Attention needed</h3>
                <div class="mt-2 text-sm text-yellow-700 flex justify-between w-full">
                    <p>Bayar dulu yaaaaa.</p>

                    <button @click="showBill=true" class="font-medium text-yellow-900">
                        Link Pembayaran
                        <i class="fa-regular fa-arrow-right ml-1" />
                    </button>
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
                    Rp {{ formatPrice(props.project.price) }}
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

        <template #footer>
            <div class="flex justify-between items-center">
                Sudah bayar?
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="showBill=false;showForm=true"
                >
                    Isi form bukti pembayaran
                </PrimaryButton>
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

                <!--                    <div class="col-span-6 sm:col-span-6">-->
                <!--                        <InputLabel for="name" value="Keterangan"/>-->
                <!--                        <TextInput-->
                <!--                            id="desc"-->
                <!--                            v-model="form.desc"-->
                <!--                            type="text"-->
                <!--                            class="mt-1 block w-full"-->
                <!--                            autocomplete="desc"-->
                <!--                            required-->
                <!--                        />-->
                <!--                        <InputError :message="form.errors.desc" class="mt-2"/>-->
                <!--                    </div>-->
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

</template>
