<script setup>
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/vue3';
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";

const props = defineProps({
    member: Object,
    course_id: Number
})

const form = useForm({
    course_id: props.course_id,
    user_id: props.member.user.id,
    status_id: null
});

const storeInformation = (status) => {
    form.status_id = status;

    form.patch(route('courseSubscribe.update', props.member), {
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
            <div class="font-medium text-gray-900 flex items-center">
                <img :src="props.member.user.profile_photo_url"
                     class="h-10 w-10 rounded-full object-cover mr-2">
                {{ props.member.user.name }}
            </div>
            <div class="flex items-center">
                <Badge :name="props.member.status" class="mr-5 " :class="props.member.color" />
                <i class="fa-regular text-gray-900 w-5" :class="show ? 'fa-angle-down' : 'fa-angle-right' " />
            </div>
        </button>
        <div v-if="show" class="">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Peserta</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">User</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ props.member.user.name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Tanggal Bergabung</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ formattedDate(props.member.created_at) }}</dd>
                    </div>
<!--                    <div class="sm:col-span-2">-->
<!--                        <dt class="text-sm font-medium text-gray-500">About</dt>-->
<!--                        <dd class="mt-1 text-sm text-gray-900" v-html="props.desc" />-->
<!--                    </div>-->
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Aksi</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600 rounded-3xl border border-gray-300">
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <i class="fa-regular fa-cat" />
                                        <span class="ml-2 w-0 flex-1 truncate">Status</span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <button @click="storeInformation(4)" class="font-medium text-primary-600">Lulus</button>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
                                        <i class="fa-regular fa-dog" />
                                        <span class="ml-2 w-0 flex-1 truncate">Status</span>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <button @click="storeInformation(5)" class="font-medium text-red-600">Tidak Lulus</button>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </li>
</template>
