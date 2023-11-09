<script setup>
import moment from "moment/moment";

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
                    <p>Jangan dulu mengerjakan proyek sebelum status berubah menjadi berlangsung.</p>

<!--                    <button @click="showBill=true" class="font-medium text-yellow-900">-->
<!--                        Link Pembayaran-->
<!--                        <i class="fa-regular fa-arrow-right ml-1" />-->
<!--                    </button>-->
                </div>
            </div>
        </div>
    </div>

</template>
