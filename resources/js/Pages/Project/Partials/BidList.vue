<script setup>
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/vue3';
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";

const props = defineProps({
    bid: Object
})

const form = useForm({
    worker_id: props.bid.user.id,
    status_id: 2
});

const storeInformation = () => {

    form.patch(route('projectBid.update', props.bid), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {

        },
        // onError: () => passwordInput.value.focus(),
        onFinish: () => {
            form.reset()
        }
    });
};

const show = ref(false)
function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <li>
        <button @click="show=!show" class="flex w-full justify-between px-6 py-4">
            <div class="font-medium text-gray-900 flex items-center">
                <img :src="props.bid.user.profile_photo_url"
                     class="h-10 w-10 rounded-full object-cover mr-2">
                {{ props.bid.user.name }}
            </div>
            <div class="flex items-center">
                <Badge :name="props.bid.status" class="mr-5" :class="props.bid.color" />
                <i class="fa-regular text-gray-900 w-5" :class="show ? 'fa-angle-down' : 'fa-angle-right' " />
            </div>
        </button>
        <div v-if="show" class="">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Bid Information</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">User</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ props.bid.user.name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Harga</dt>
                        <dd class="mt-1 text-sm text-gray-900">Rp {{ formatPrice(props.bid.price) }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">About</dt>
                        <dd class="mt-1 text-sm text-gray-900" v-html="props.bid.desc" />
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Aksi</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="divide-y divide-gray-300 rounded-3xl border border-gray-300">
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <i class="fa-regular fa-cat" />
                                        <span class="ml-2 w-0 flex-1 truncate">Lorem ipsum</span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <button @click="storeInformation" class="font-medium text-green-600">Pilih Worker</button>
                                    </div>
                                </li>
<!--                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">-->
<!--                                    <div class="flex w-0 flex-1 items-center">-->
<!--                                        <i class="fa-regular fa-dog" />-->
<!--                                        <span class="ml-2 w-0 flex-1 truncate">Dolor sit amet</span>-->
<!--                                    </div>-->
<!--                                    <div class="ml-4 flex-shrink-0">-->
<!--                                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>-->
<!--                                    </div>-->
<!--                                </li>-->
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </li>
</template>
