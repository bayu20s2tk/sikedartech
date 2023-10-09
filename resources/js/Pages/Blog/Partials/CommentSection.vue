<script setup>
import moment from "moment/moment";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import {comment} from "postcss";
import CommentChildSection from "./CommentChildSection.vue";

const props = defineProps({
    blog_id: Number,
    comment: Object,
    comment_idx: Number
})

const form = useForm({
    id: null,
    comment: null,
    blog_id: props.blog_id,
    parent_id: props.comment.id
});

const storeInformation = () => {
    // if (props.blog.name == null) {
    form.post(route('blogComment.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            show.value=false
        },
    });
    // } else {
    //     form.put(route('blog.update', props.blog), {
    //         errorBag: 'updateInformation',
    //         preserveScroll: true,
    //         onSuccess: () => showPage(),
    //     });
    // }
};

const likeComment = (item) => {
    form.post(route('blogComment.like', item), {
        // errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {

        },
    });
};

const dislikeComment = (item) => {
    form.post(route('blogComment.dislike', item), {
        // errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {

        },
    });
};

const show = ref(false)
function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <div class="flex space-x-4 text-sm text-gray-500">
        <div class="flex-none py-5">
            <img :src="props.comment.user.profile_photo_url" alt="" class="h-10 w-10 rounded-full bg-gray-100" />
        </div>
        <div :class="[props.comment_idx === 0 ? '' : 'border-t border-gray-300', 'flex-1 py-3']">
            <h3 class="font-medium text-sm text-gray-900">{{ props.comment.user.name }}</h3>
            <div class="prose prose-sm max-w-none text-gray-500" v-html="props.comment.content" />
            <p class="text-xs">
                <time :datetime="formattedDate(props.comment.created_at)">
                    {{ formattedDate(props.comment.created_at) }}
                </time>
            </p>
            <div class="flex justify-between gap-5 mt-2">
                <div class="flex-grow" >
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
                        <button type="button" @click="likeComment(props.comment.id)">
                            <i class="text-lg fa-heart"
                               :class="props.comment.has_upvoted ? 'fa-solid text-red-600' : 'fa-regular text-primary-600' " />
                        </button>
                        <span
                            v-if="props.comment.likes != 0"
                            :class="props.comment.has_upvoted ? 'text-red-600' : 'text-primary-600' "
                        >{{ props.comment.likes }}</span>
                    </div>

                    <div class="space-x-2">
                        <button type="button" @click="dislikeComment(props.comment.id)">
                            <i class="text-lg fa-thumbs-down"
                               :class="props.comment.has_downvoted ? 'fa-solid text-primary-600' : 'fa-regular text-primary-600' " />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template v-for="(child, childIdx ) in props.comment.child">
        <CommentChildSection
            :course_id="props.course_id"
            :comment="props.comment"
            :child="child"
            :child_idx="childIdx"
        />
    </template>
</template>
