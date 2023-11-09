<script setup>
import moment from "moment/moment";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import DialogModal from "./DialogModal.vue";
import InputLabel from "./InputLabel.vue";
import ActionMessage from "./ActionMessage.vue";
import DangerButton from "./DangerButton.vue";

const props = defineProps({
    course_id: Number,
    project_id: Number,
    blog_id: Number,
    comment: Object,
    child: Object,
    child_idx: Number,
    mother: {
        type: Boolean,
        default: false
    }
})

const form = useForm({
    id: null,
    comment: null,
    course_id: props.course_id,
    blog_id: props.blog_id,
    parent_id: props.child.id
});

const storeInformation = () => {
    if (props.course_id != null) {
        form.post(route('courseComment.store'), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => {
                form.reset()
                show.value=false
            },
        });
    } else if (props.blog_id != null) {
        form.post(route('blogComment.store'), {
            errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {
                form.reset()
                show.value=false
            },
        });
    }
};

const likeComment = (item) => {
    if (props.course_id != null) {
        form.post(route('courseComment.like', item), {
            // errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {

            },
        });
    } else if (props.blog_id != null) {
        form.post(route('blogComment.like', item), {
            // errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {

            },
        });
    }
};

const dislikeComment = (item) => {
    if (props.course_id != null) {
        form.post(route('courseComment.dislike', item), {
            // errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {

            },
        });
    } else if (props.blog_id != null) {
        form.post(route('blogComment.dislike', item), {
            // errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {

            },
        });
    }
};

const formReport = useForm({
    id: null,
    course_id: props.course_id ?? null,
    project_id: props.project_id ?? null,
    blog_id: props.blog_id ?? null,
    comment_id: props.comment.id,
    category_id: null,
    desc: null
});
const reportInformation = () => {
    formReport.post(route('complaint.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            setTimeout(() => closeModal(), 2000);
            formReport.reset()
        }
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
};

const confirmingModal = ref(false)
const closeModal = () => {
    confirmingModal.value = false;
    // form.reset();
}

const show = ref(false)
function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}


</script>

<template>
    <div class="flex space-x-4 text-sm text-gray-500 ml-10 ">
        <div class="flex-none py-0">
            <img :src="props.child.user.profile_photo_url" alt="" class="h-10 w-10 rounded-full bg-gray-100" />
        </div>
        <div :class="[props.child_idx === 0 ? '' : '', 'flex-1 pb-3']">
            <h3 class="font-medium text-sm text-gray-900">
                {{ props.child.user.name }}
                <template v-if="props.child.mother_name && props.mother">
                    <i class="fa-regular fa-angle-right" />
                    {{ props.child.mother_name }}
                </template>
            </h3>
            <div class="prose prose-sm max-w-none text-gray-500" v-html="props.child.content" />
            <p class="text-xs">
                <time :datetime="formattedDate(props.child.created_at)">
                    {{ formattedDate(props.child.created_at) }}
                </time>
            </p>
            <div class="flex justify-between items-start gap-5 mt-2" >
                <div class="" >
                    <button @click="show=!show" class="font-medium text-primary-600">Balas</button>
                    <div v-if="show" class="">
                        <TextAreaInput
                            id="comment"
                            v-model="form.comment"
                            class="mt-1 block w-full"
                            rows="2"
                            autofocus
                            required
                        />
                        <PrimaryButton
                            as="button"
                            @click="storeInformation"
                            class="mt-3"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Kirim
                        </PrimaryButton>
                        <InputError :message="form.errors.comment" class="mt-2" />
                    </div>
                </div>
                <div class="flex-none flex space-x-5 mr-5">
                    <div class="space-x-2">
                        <button type="button" @click="likeComment(props.child.id)">
                            <i class="text-lg fa-heart"
                               :class="props.child.has_upvoted ? 'fa-solid text-red-600' : 'fa-regular text-primary-600' " />
                        </button>
                        <span
                            v-if="props.child.likes != 0"
                            :class="props.child.has_upvoted ? 'text-red-600' : 'text-primary-600' "
                        >{{ props.child.likes }}</span>
                    </div>

                    <div class="space-x-2">
                        <button type="button" @click="dislikeComment(props.child.id)">
                            <i class="text-lg fa-thumbs-down"
                               :class="props.child.has_downvoted ? 'fa-solid text-red-600' : 'fa-regular text-red-600' " />
                        </button>
                    </div>

                    <div class="space-x-2">
                        <button type="button" @click="confirmingModal=true">
                            <i class="text-lg fa-regular fa-triangle-exclamation text-red-600" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template v-for="(child, childIdx ) in props.child.child">
        <CommentChildSection
            :course_id="props.course_id"
            :comment="props.comment"
            :child="child"
            :child_idx="childIdx"
            :mother="true"
        />
    </template>

    <DialogModal :show="confirmingModal" @close="closeModal">
        <template #title>
            Silahkan pilih alasan
        </template>

        <template #content>
            <fieldset>
                <div class="space-y-5">
                    <div v-for="(complaint, key) in $page.props.selectComplaint" :key="key" class="relative flex items-start">
                        <div class="flex h-5 items-center">
                            <input
                                :id="key"
                                v-model.number="formReport.category_id"
                                type="radio"
                                :value="key"
                                class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500"
                                required
                            />
                        </div>
                        <div class="ml-3 text-sm">
                            <InputLabel :value="complaint" />
                            <!--                            <label class="font-medium text-gray-700">{{ complaint }}</label>-->
                            <!--                            <p :id="`${index}-description`" class="text-gray-500">{{ index }}</p>-->
                        </div>
                    </div>
                </div>
                <InputError :message="formReport.errors.category_id" class="mt-2" />
            </fieldset>

            <div class="mt-10" >
                <InputLabel for="desc" class="ml-2" value="Keterangan"/>
                <TextAreaInput
                    id="desc"
                    v-model="formReport.desc"
                    class="mt-1 block w-full"
                    rows="2"
                    required
                />
                <InputError :message="formReport.errors.desc" class="mt-2" />
            </div>
        </template>

        <template #footer>
            <ActionMessage :on="formReport.recentlySuccessful" class="mr-3">
                Berhasil disimpan.
            </ActionMessage>

            <DangerButton
                :class="{ 'opacity-25': formReport.processing }"
                :disabled="formReport.processing"
                @click.prevent="reportInformation"
            >
                Laporkan
            </DangerButton>
        </template>
    </DialogModal>
</template>
