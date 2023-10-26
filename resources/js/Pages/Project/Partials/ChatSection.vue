<script setup>

import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import {onUnmounted} from "vue";
import {router, useForm} from "@inertiajs/vue3";
import moment from "moment/moment";

const props = defineProps({
    project: Object,
    chat: Object
});

// onMounted(() => {
//     router.reload({ only: ['chat'] })
// })

onUnmounted(() => {
    clearInterval(interval)
})

const interval = setInterval(() => {
    console.log('interval');
    router.reload({ only: ['chat'] })
}, 8000)

const form = useForm({
    project_id: props.project.id,
    message: null,
});

const storeInformation = () => {
    form.post(route('projectChat.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
    });
};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>
    <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-y-auto h-96 min-h-full">
        <ul role="list" class="">
            <template v-for="chat in props.chat">
                <template v-if="chat.user_id==$page.props.user.id">
                    <li class="p-2 flex justify-end">
                        <div class="space-y-2 ml-2 px-3 py-2 rounded-3xl border border-gray-300 shadow-lg">
                            <div class="font-medium text-sm max-w-lg">
                                <p class="text-gray-900">
                                    {{ chat.message }}
                                </p>
                                <p class="text-gray-500 text-xs mt-2">
                                    <i class="fa-regular fa-check" />
                                    {{ formattedDate(chat.created_at) }}
                                </p>
                            </div>
                        </div>
                    </li>
                </template>

                <template v-else>
                    <li class="p-2 flex">
                        <img class="h-10 w-10 rounded-full" :src="chat.user.profile_photo_url" alt="" />
                        <div class="space-y-2 ml-2 px-3 py-2 rounded-3xl border border-gray-300 shadow-lg">
                            <div class="font-medium text-sm max-w-lg">
                                <p class="text-gray-900">
                                    {{ chat.message }}
                                </p>
                                <p class="text-gray-500 text-xs mt-2">
                                    <!--                                                <i class="fa-regular fa-check" />-->
                                    {{ formattedDate(chat.created_at) }}
                                </p>
                            </div>
                        </div>
                    </li>
                </template>
            </template>

        </ul>
    </div>

    <div class="mt-2 flex justify-between">
        <div class="w-full mr-2">
            <TextInput
                v-model="form.message"
                type="text"
                class="block w-full"
                placeholder="Ketik pesan"
                required
            />
            <InputError :message="form.errors.message" class="mt-2"/>
        </div>
        <button
            @click="storeInformation"
            :disabled="form.message==''"
            class="nightwind-prevent flex items-center justify-center rounded-full border border-transparent bg-primary-600 disabled:opacity-25 h-10 w-10 p-2 text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
            <i class="fa-duotone fa-paper-plane " />
        </button>
    </div>
</template>
