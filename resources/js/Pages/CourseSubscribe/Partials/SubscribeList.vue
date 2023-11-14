<script setup>
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/vue3';
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";

const props = defineProps({
    item: Object
})

const form = useForm({
    course_id: props.item.course.id,
    user_id: props.item.user.id,
    status_id: null
});

const storeInformation = (status) => {
    form.status_id = status;

    form.patch(route('courseSubscribe.update', props.item), {
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
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <li>
        <button @click="show=!show" class="flex w-full justify-between px-6 py-4">
            <div class="">
                <p class="font-medium text-gray-900">
                    <i class="fa-regular fa-book mr-2" />
                    {{ props.item.course.name }}
                </p>
            </div>
            <div class="">
                <Badge :name="props.item.status" class="mr-5" :class="props.item.color" />
                <i class="fa-regular text-gray-900 w-5" :class="show ? 'fa-angle-down' : 'fa-angle-right' " />
            </div>
        </button>
        <div v-if="show" class="grid sm:grid-cols-6">
            <div class="sm:col-span-2 flex justify-center items-center">
                <img :src="props.item.media[0]?.original_url" class="">
            </div>

            <div class="w-full p-5 sm:col-span-4">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Billing Kelas</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Informasi kelas per user</p>
                </div>
                <div class="mt-5 border-t border-gray-200">
                    <dl class="sm:divide-y sm:divide-gray-300">
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.item.course.name }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500">Pengguna</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ props.item.user.name }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500">Harga Kelas</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">Rp {{ formatPrice(props.item.course.price) }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Request</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ formattedDate(props.item.created_at) }}</dd>
                        </div>
                        <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5" v-if="props.item.status_id==1">
                            <dt class="text-sm font-medium text-gray-500">Aksi</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <ul role="list" class="divide-y divide-gray-300 rounded-3xl border border-gray-300">
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <i class="fa-regular fa-cat" />
                                            <span class="ml-2 w-0 flex-1 truncate">Status</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <button @click="storeInformation(2)" class="font-medium text-green-600">Accept</button>
                                        </div>
                                    </li>
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <i class="fa-regular fa-dog" />
                                            <span class="ml-2 w-0 flex-1 truncate">Status</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <button @click="storeInformation(3)" class="font-medium text-red-600">Reject</button>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </li>
</template>
