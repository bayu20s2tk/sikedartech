<script setup>
import moment from "moment/moment";

const props = defineProps({
    project: Object,
})

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
</script>

<template>
    <div class="overflow-hidden bg-white bg-opacity-50 shadow-lg rounded-3xl border border-gray-300">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Ringkasan</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Proyek</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ props.project.name }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Owner</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ props.project.user.name }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Worker</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ props.project.worker.name }}</dd>
                </div>

                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Harga</dt>
                    <dd class="mt-1 text-sm text-gray-900">Rp {{ formatPrice(props.project.price) }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                    <dd class="mt-1 text-sm text-gray-900 prose prose-sm lg:prose-lg xl:prose-2xl" v-html="props.project.desc" />
                </div>
            </dl>
        </div>
    </div>
</template>
