<script setup>
import {ref} from "vue";
import {Link, useForm} from '@inertiajs/vue3';
import Badge from "@/Components/Badge.vue";
import moment from "moment/moment";

const props = defineProps({
    item: Object
})

const form = useForm({
    id: props.item.id,
    user_id: props.item.course_comment?.user.id ?? props.item.blog_comment?.user.id,
    status_id: null,
});

const storeInformation = (action) => {
    if (action) {
        form.status_id = true
    } else {
        form.status_id = false
    }
    // form.status_id = !!action;

    form.put(route('complaint.update', props.item), {
        errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        }
    });
};

const show = ref(false)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <li>
        <button @click="show=!show" class="flex w-full justify-between px-6 py-4">
            <div class="">
                <p class="font-medium text-gray-900">
                    <i class="fa-regular fa-triangle-exclamation text-red-600 mr-2" />
                    <span class="text-gray-500 font-normal">#{{ props.item.id }}</span>
                    {{ props.item.user.name }}
                </p>
            </div>
            <div class="">
<!--                <Badge :name="props.item.status" class="mr-5" :class="props.item.color" />-->
<!--                <i class="fa-regular text-gray-900 w-5" :class="show ? 'fa-angle-down' : 'fa-angle-right' " />-->
                <Badge :name="props.item.status" class="mr-5" :class="props.item.color" />
                <i class="fa-regular text-gray-900 w-5" :class="show ? 'fa-angle-down' : 'fa-angle-right' " />
            </div>
        </button>
        <div v-if="show" class="">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Pengaduan</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Lorem ipsum dolor sit amet.</p>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ formattedDate(props.item.created_at) }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ props.item.category }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Pelapor</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ props.item.user.name }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Terdakwa</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <template v-if="props.item.course">
                                {{ props.item.course_comment.user.name }}
                            </template>
                            <template v-else-if="props.item.blog">
                                {{ props.item.blog_comment.user.name }}
                            </template>
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Komentar</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <template v-if="props.item.course">
                                {{ props.item.course_comment.content }}
                            </template>
                            <template v-else-if="props.item.blog">
                                {{ props.item.blog_comment.content }}
                            </template>
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Aksi</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <ul role="list" class="divide-y divide-gray-300 rounded-3xl border border-gray-300">
                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
<!--                                        <i class="fa-regular fa-dog" />-->
<!--                                        <span class="ml-2 w-0 flex-1 truncate">Dolor sit amet</span>-->
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a
                                            v-if="props.item.course"
                                            target="_blank"
                                            :href="route('landing.course.show', props.item.course)"
                                            class="font-medium text-primary-600 hover:text-indigo-500">
                                            Lihat Kelas
                                        </a>
                                        <a
                                            v-else-if="props.item.blog"
                                            target="_blank"
                                            :href="route('landing.blog.show', props.item.blog)"
                                            class="font-medium text-primary-600 hover:text-indigo-500">
                                            Lihat Artikel
                                        </a>
                                    </div>
                                </li>

                                <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div class="flex w-0 flex-1 items-center">
<!--                                        <i class="fa-regular fa-cat" />-->
<!--                                        <span class="ml-2 w-0 flex-1 truncate">Lorem ipsum</span>-->
                                    </div>
                                    <div class="ml-4 flex-shrink-0 space-x-5">
                                        <button @click.prevent="storeInformation(false)" class="font-medium text-green-600">Abaikan</button>
                                        <button @click.prevent="storeInformation(true)" class="font-medium text-red-600">Blokir User</button>
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
