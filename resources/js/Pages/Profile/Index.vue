<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {Link, router, useForm, usePage} from "@inertiajs/vue3";
import MobileMenu from "@/Components/MobileMenu.vue";
import DarkmodeToggle from "@/Components/DarkmodeToggle.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {computed, onMounted, ref, watch} from "vue";
import moment from "moment/moment";
import DialogModal from "../../Components/DialogModal.vue";
import InputLabel from "../../Components/InputLabel.vue";
import ActionMessage from "../../Components/ActionMessage.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";

const props = defineProps({
    // history: Object,
    // flip_saldo: undefined,
    // digiflazz_saldo: undefined,
})

const {...userInfo} = computed(() => usePage().props.user).value;

const form = useForm({
    id: null,
    amount: parseInt(userInfo.wallet_balance),
});

const storeInformation = () => {
    form.post(route('withdraw.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            setTimeout(() => closeModal(), 2000);
            form.reset()
        }
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
};

const darkMode = ref(JSON.parse(localStorage.getItem('darkmode')) ?? false)

watch(darkMode, (newDarkMode) => {
    console.log(`darkmode is ${newDarkMode}`)
    localStorage.setItem('darkmode', JSON.stringify(newDarkMode))
})

const logout = () => {
    router.post(route('logout'));
};

const confirmingModal = ref(false)
const closeModal = () => {
    confirmingModal.value = false;
    // form.reset();
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    let val = (value / 1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

</script>

<template>
    <AppLayout title="Saya"
               :name="$page.props.user.name"
               :desc="$page.props.user.email"
               :avatar="$page.props.user.profile_photo_url"
    >

        <div
            class="col-span-1 divide-y md:divide-none divide-gray-300 dark:divide-gray-600 rounded-3xl bg-white bg-opacity-50 shadow-lg border border-gray-300">
            <div class="flex space-x-6 md:hidden">
                <img :src="$page.props.user.profile_photo_url" class="w-full object-cover rounded-t-3xl aspect-video">
            </div>
            <div>
                <div class="-mt-px flex divide-x divide-gray-300 dark:divide-gray-600">
                    <div class="flex w-0 flex-1">
                        <div
                            class="relative -mr-px grid w-0 flex-1 items-center justify-center rounded-bl-lg border border-transparent py-4">
                            <div class="text-xs text-gray-500">Saldo</div>
                            <div class="text-sm font-medium text-gray-700">Rp
                                {{ formatPrice($page.props.user.wallet_balance) }}
                            </div>
                        </div>
                    </div>
<!--                    <div class="-ml-px flex w-0 flex-1">-->
<!--                        <button-->
<!--                            @click="confirmingModal=true"-->
<!--                            class="relative grid w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4">-->
<!--                            &lt;!&ndash;                            <div class="text-xs text-gray-500">Uang keluar</div>&ndash;&gt;-->
<!--                            <div class="text-sm font-medium text-primary-700">-->
<!--                                <i class="fa-duotone fa-dollar-sign mr-2"/>Withdraw-->
<!--                            </div>-->
<!--                        </button>-->
<!--                    </div>-->
                </div>
            </div>
        </div>

        <div
            class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <li>
                    <button @click="confirmingModal=true" class="w-full flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Withdraw</p>
<!--                        <i class="fa-regular fa-money-bill text-gray-900"/>-->
                    </button>
                </li>
                <li>
                    <Link :href="route('profile.show')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Ubah data profil</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li class="block lg:hidden">
                    <Link :href="route('profile.index')" @click="darkMode=!darkMode"
                          class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Mode {{ darkMode ? 'gelap' : 'terang' }}</p>
                        <i class="fa-regular text-gray-900" :class="darkMode ? 'fa-moon' : 'fa-sun-bright' "/>
                    </Link>
                </li>
            </ul>
        </div>


        <div
            class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg"
            v-if="$page.props.user.role_id==1">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <li>
                    <Link :href="route('setting.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Pengaturan aplikasi</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li>
                    <Link :href="route('user.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Data pengguna</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li>
                    <Link :href="route('gallery.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Galeri</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li>
                    <Link :href="route('projectCategory.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Kategori Proyek</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li>
                    <Link :href="route('courseCategory.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Kategori Kelas</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
                <li>
                    <Link :href="route('blogCategory.index')" class="flex justify-between px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Kategori Artikel</p>
                        <i class="fa-regular fa-angle-right text-gray-900"/>
                    </Link>
                </li>
            </ul>
        </div>

        <div
            class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                <li>
                    <Link :href="route('terms.show')" class="block px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Ketentuan Layanan</p>
                    </Link>
                </li>

                <li>
                    <Link :href="route('policy.show')" class="block px-6 py-4">
                        <p class="text-sm font-medium text-gray-900">Kebijakan Privasi</p>
                    </Link>
                </li>
            </ul>
        </div>

        <form method="POST" @submit.prevent="logout">
            <DangerButton type="submit" class="w-full">
                Keluar
            </DangerButton>
        </form>

        <DialogModal :show="confirmingModal" @close="closeModal">
            <template #title>
                Withdraw
            </template>

            <template #content>
                <div class="">
                    <InputLabel for="price" value="Nominal"/>
                    <div class="flex">
                      <span class="flex items-center bg-white text-black border border-gray-300 border-r-0 rounded-3xl rounded-r-none shadow-sm mt-1 px-3 ">
                          Rp
                      </span>
                        <TextInput
                            id="price"
                            v-model="form.amount"
                            type="number"
                            min="10000"
                            :max="Number($page.props.user.wallet_balance)"
                            class="mt-1 block w-full rounded-l-none"
                            required
                        />
                    </div>
                    <InputError :message="form.errors.amount" class="mt-2"/>
                </div>

            </template>

            <template #footer>
                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Berhasil disimpan.
                </ActionMessage>

                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click.prevent="storeInformation"
                >
                    Withdraw
                </PrimaryButton>
            </template>
        </DialogModal>
        <MobileMenu/>
    </AppLayout>
</template>
