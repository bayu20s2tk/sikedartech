<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {StarIcon} from "@heroicons/vue/20/solid";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment/moment";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    project: Object,
    worker_id: Number,
    owner_id: Number
});

const review = ref(false)

const form = useForm({
    desc: null,
    rating: null,
    worker_id: props.worker_id ?? null,
    owner_id: props.owner_id ?? null,
    project_id: props.project_id,
});

const storeReview = () => {
    form.post(route('review.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            review.value=false
        },
    });
};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <div class="mt-10">
        <div class="lg:grid lg:grid-cols-12">
            <div class="lg:col-span-4">

                <div class="mt-10">
                    <h3 class="font-medium text-gray-900">
                        <template v-if="props.worker_id">
                            Review untuk {{ props.project.worker.name }} sebagai Worker
                        </template>
                        <template v-else>
                            Review untuk {{ props.project.user.name }} sebagai Owner
                        </template>
                    </h3>
                    <p class="mt-1 text-sm text-gray-600">Bagikan pemikiran anda</p>

                    <SecondaryButton
                        v-if="!review"
                        @click="review=!review"
                        class="w-full justify-center mt-3">
                        Buat review
                    </SecondaryButton>

<!--                    <p v-if="$page.props.user_status!=4" class="text-sm mt-1 text-gray-700">*Bisa review setelah lulus</p>-->

                    <div class="my-10 prose prose-sm" v-if="review">
                        <InputLabel for="steps-range" value="Range"/>
                        <input
                            id="steps-range"
                            type="range"
                            min="1"
                            max="5"
                            step="1"
                            v-model="form.rating"
                            class="w-full h-2 bg-yellow-400 rounded-full appearance-none cursor-pointer">

                        <div class="w-full flex justify-between text-xs px-2 text-gray-900">
                            <span v-for="val in 5">{{ val }}</span>
                        </div>
                        <InputError :message="form.errors.rating" class="mt-2"/>

                        <InputLabel for="review" class="mt-3" value="Komentar"/>
                        <TextAreaInput
                            id="review"
                            v-model="form.desc"
                            class="mt-1 block w-full"
                            rows="2"
                            required
                        />
                        <InputError :message="form.errors.desc" class="mt-2"/>

                        <PrimaryButton
                            as="button"
                            @click="storeReview"
                            class="mt-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Kirim
                        </PrimaryButton>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
