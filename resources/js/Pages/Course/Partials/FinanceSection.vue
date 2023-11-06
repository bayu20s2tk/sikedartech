<script setup>
import moment from "moment/moment";

const props = defineProps({
    course: Object,
    subscriber: Object
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
    <div class="mt-10 overflow-hidden bg-white bg-opacity-50 shadow-lg rounded-3xl border border-gray-300">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Keuangan</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and application.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
<!--                <template v-for="sub in props.subscriber">-->
<!--                    <div class="sm:col-span-2">-->
<!--                        <dt class="text-sm font-medium text-gray-500">{{ sub.name }}</dt>-->
<!--                        <dd class="mt-1 text-sm text-gray-900">+ Rp {{ formatPrice(props.course.price) }}</dd>-->
<!--                    </div>-->
<!--                </template>-->

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-900">
                        <span class="text-gray-500">
                            Harga kelas
                            <i class="fa-regular fa-xmark" />
                            peserta =
                        </span> Total Saldo
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">
                        <span class="text-sm text-gray-500">
                            Rp {{ formatPrice(props.course.price) }}
                            <i class="fa-regular fa-xmark" /> {{ props.subscriber.length }} =
                        </span>
                        Rp {{ formatPrice(Number(props.subscriber?.length) * Number(props.course.price)) }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>
