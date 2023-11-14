<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {Link, usePage} from "@inertiajs/vue3";
import 'vue3-carousel/dist/carousel.css'
import {Carousel, Slide, Pagination, Navigation} from 'vue3-carousel'
import {Editor, EditorContent, useEditor} from '@tiptap/vue-3'
import StarterKit from "@tiptap/starter-kit";
import Image from '@tiptap/extension-image';
import 'tippy.js/dist/tippy.css'; // optional for styling
import {computed, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import InputError from "@/Components/InputError.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CommentSection from "@/Components/CommentSection.vue";
import Heading from "@/Components/Heading.vue";
import CourseLayout from "@/Layouts/CourseLayout.vue";
import {StarIcon} from '@heroicons/vue/20/solid';
import SecondaryButton from "../../Components/SecondaryButton.vue";
import Badge from "../../Components/Badge.vue";

const props = defineProps({
    course: Object,
    comment: Object,
});

const editor = useEditor({
    content: props.course.content,
    editorProps: {
        attributes: {
            class: 'prose prose-sm lg:prose-lg xl:prose-2xl',
        },
    },
    extensions: [
        StarterKit.configure({
            paragraph: {
                HTMLAttributes: {
                    class: 'text-base text-gray-600',
                },
            },
            Heading: {
                HTMLAttributes: {
                    class: 'text-gray-900',
                },
            },
        }),
        Image.configure({
            inline: true,
            allowBase64: true,
            HTMLAttributes: {
                class: 'max-w-5xl mx-auto rounded-3xl',
            },
        })
    ],
    autofocus: false,
    editable: false,
})

const courseTab = ref(props.course.item[0]?.id)
const tab = ref(1)
const review = ref(false)

const form = useForm({
    id: null,
    comment: null,
    course_id: props.course.id,
});

const {...userInfo} = computed(() => usePage().props.user).value;
// console.log(userInfo.name);

const formReview = useForm({
    desc: null,
    rating: null,
    // user_id: userInfo.id,
    course_id: props.course.id,
});

const storeInformation = () => {
    console.log(form.comment);
    // if (props.course.name == null) {
    form.post(route('courseComment.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
    });
    // } else {
    //     form.put(route('course.update', props.course), {
    //         errorBag: 'updateInformation',
    //         preserveScroll: true,
    //         onSuccess: () => showPage(),
    //     });
    // }
};

const storeReview = () => {
    formReview.post(route('review.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            formReview.reset()
            review.value=false
        },
    });
};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>

    <CourseLayout :title="props.course.name">

        <div class="relative">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:items-start">
                <div class="px-4 sm:px-6 lg:px-0">
                    <Heading>
                        <template #header>
                            <p class="text-lg text-primary-500 font-medium">
<!--                                <i class="fa-regular mr-2" :class="course.category.icon"/>-->
<!--                                {{ course.category.name }}-->
                                <Badge v-if="$page.props.user_status==4" name="Kamu sudah lulus kelas ini" class="mb-2 text-green-800 bg-green-100" />
                            </p>
                            {{ props.course.name }}
                        </template>
                        <template #desc>
                            {{ course.desc }}
                        </template>
                    </Heading>
                </div>

                <div class="relative mx-auto grid lg:grid-cols-6 gap-10 px-4 sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="lg:col-span-2">
                        <!--                        <h2 class="text-3xl text-gray-900 font-extrabold tracking-tight sm:text-4xl">-->
                        <!--                            {{ course.name }}-->
                        <!--                        </h2>-->
                        <div class="mt-3 text-gray-500 space-y-6">
                            <!--                            <p class="text-primary-500 font-medium">-->
                            <!--                                <i class="fa-regular mr-2" :class="course.category.icon"/>-->
                            <!--                                {{ course.category.name }}-->
                            <!--                            </p>-->

                            <!--                            <p class="text-gray-700">-->
                            <!--                                {{ course.desc }}-->
                            <!--                            </p>-->

                            <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                                <div class="px-3 py-5 grid gap-3 ">
                                    <h3 class="font-semibold text-gray-900 ml-2">
                                        {{ props.course.item.length ?? '0' }} lessons
                                    </h3>

                                    <template v-for="(list, listIdx) in props.course.item" :key="list.id">
                                        <button @click="courseTab=list.id">
                                            <div
                                                class="rounded-3xl py-3 px-5 text-left"
                                                :class="courseTab==list.id ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                            >
                                                <i class="fa-solid fa-play mr-1"/>
                                                {{ list.name }}
                                            </div>
                                        </button>
                                    </template>

                                </div>
                            </div>

                            <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                                <div class="px-3 py-5 grid gap-3 ">
                                    <h3 class="font-semibold text-gray-900 ml-2">
                                        {{ props.course.assigment.length ?? '0' }} tugas
                                    </h3>

                                    <template v-for="(list, listIdx) in props.course.assigment" :key="list.id">
                                        <button @click="courseTab=list.id">
                                            <div
                                                class="rounded-3xl py-3 px-5 text-left"
                                                :class="courseTab==list.id ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                            >
                                                <i class="fa-solid fa-play mr-1"/>
                                                {{ list.name }}
                                            </div>
                                        </button>
                                    </template>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 py-3">
                        <template v-for="(item, itemIdx) in props.course.item">
                            <template v-if="courseTab==item.id" class="">
                                <!--                                <h3 class="text-gray-900 font-semibold text-xl mb-5" v-html="item.name" />-->
                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="item.content"/>
                            </template>
                        </template>

                        <template v-for="(item, itemIdx) in props.course.assigment">
                            <template v-if="courseTab==item.id" class="">
                                <div class="">
                                    <h3 class="font-semibold mb-2">Deskripsi</h3>
                                    <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="item.content"/>
                                </div>

                                <div class="mt-10">
                                    <h3 class="font-semibold mb-2">Tautan</h3>
                                    <a :href="item.link" target="_blank" class="text-primary-700">{{
                                            item.link ?? '-'
                                        }}</a>
                                </div>

                                <div class="mt-10">
                                    <h3 class="font-semibold mb-2">Lampiran</h3>
                                    <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-5">
                                        <template v-for="(media, index) in item.media">
                                            <div
                                                class="relative py-3 px-2 flex flex-col items-center justify-center border border-gray-300 rounded-3xl shadow-xl">
                                                <i class="fa-duotone fa-file text-gray-400 text-5xl"></i>
                                                <div class="text-center mt-2">
                                                    <p class="block text-sm font-medium text-gray-900">
                                                        {{ media.file_name }}</p>
                                                    <a
                                                        type="button"
                                                        :href="media.original_url"
                                                        :download="media.file_name"
                                                        class="text-primary-600 text-xs font-semibold"
                                                    >
                                                        Download
                                                    </a>

                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>

                    <!--                      <EditorContent-->
                    <!--                          :editor="editor"-->
                    <!--                          required/>-->

                    <!--                    <Carousel -->
                    <!--                        v-if="course.media[0]" -->
                    <!--                        :items-to-show="1" -->
                    <!--                        :wrap-around="true" -->
                    <!--                        :transition="1000"-->
                    <!--                        :autoplay="5000"-->
                    <!--                    >-->
                    <!--                        <template #slides>-->
                    <!--                            <Slide v-for="media in course.media" :key="media.id">-->
                    <!--                                <div class="carousel__item w-full aspect-square rounded-3xl relative">-->
                    <!--                                    <img class="object-cover w-full aspect-square rounded-3xl"-->
                    <!--                                         :src="media.original_url">-->
                    <!--                                </div>-->
                    <!--                            </Slide>-->
                    <!--                        </template>-->
                    <!--                        <template #addons>-->
                    <!--                            &lt;!&ndash;                                        <Navigation />&ndash;&gt;-->
                    <!--                            <Pagination/>-->
                    <!--                        </template>-->
                    <!--                    </Carousel>-->

                </div>

                <div class="relative mx-auto px-4 sm:px-6 lg:px-0">
                    <div class=" mt-10">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="tab=1"
                                    :class="[tab==1 ?
                                    'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"
                            >
                                About
                            </button>
                            <button @click="tab=2"
                                    :class="[tab==2 ?
                                    'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"
                            >
                                Komentar
                            </button>
                            <button @click="tab=3"
                                    :class="[tab==3 ?
                                    'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"
                            >
                                Review
                            </button>
                        </nav>

                        <div class="my-5 ">
                            <template v-if="tab==1">
                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="props.course.about"/>
                            </template>

                            <template v-else-if="tab==2">
                                <div class="mb-10 prose prose-sm" v-if="$page.props.user">
                                    <InputLabel for="desc" class="ml-2" value="Beri Komentar"/>
                                    <TextAreaInput
                                        id="comment"
                                        v-model="form.comment"
                                        class="mt-1 block w-full"
                                        rows="2"
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
                                    <InputError :message="form.errors.comment" class="mt-2"/>
                                </div>

                                <div class="prose prose-sm">
                                    <template v-for="(comment, commentIdx) in props.comment" :key="comment.id">
                                        <CommentSection
                                            :course_id="props.course.id"
                                            :comment="comment"
                                            :comment_idx="commentIdx"
                                        />
                                    </template>
                                </div>
                            </template>

                            <template v-else-if="tab==3">
                                <!-- Stats section -->
                                <div class="mt-10">
                                    <div class="lg:grid lg:grid-cols-12">
                                        <div class="lg:col-span-4">
<!--                                            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Reviews</h2>-->
                                            <div class="mt-3 flex items-center">
                                                <div>
                                                    <div class="flex items-center">
                                                        <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                                                          :class="[Number(props.course.review_average) > rating ? 'text-yellow-400' : 'text-gray-300', 'flex-shrink-0 h-5 w-5']"
                                                          aria-hidden="true"/>
                                                    </div>
                                                </div>
                                                <p class="ml-2 text-sm text-gray-900">Based on {{ props.course.review.length }} reviews</p>
                                            </div>

                                            <div class="mt-10">
                                                <h3 class="font-medium text-gray-900">Bagikan pemikiran anda</h3>
                                                <p class="mt-1 text-sm text-gray-600">Bagikan pemikiran Anda dengan pengguna lain</p>

                                                <SecondaryButton
                                                    v-if="!review"
                                                    @click="review=!review"
                                                    :disabled="$page.props.user_status!=4"
                                                    class="w-full justify-center mt-3">
                                                    Buat review
                                                </SecondaryButton>

                                                <p v-if="$page.props.user_status!=4" class="text-sm mt-1 text-gray-700">*Bisa review setelah lulus</p>

                                                <div class="my-10 prose prose-sm" v-if="review">
                                                    <InputLabel for="steps-range" value="Range"/>
                                                    <input
                                                        id="steps-range"
                                                        type="range"
                                                        min="1"
                                                        max="5"
                                                        step="1"
                                                        v-model="formReview.rating"
                                                        class="w-full h-2 bg-yellow-400 rounded-full appearance-none cursor-pointer">

                                                    <div class="w-full flex justify-between text-xs px-2 text-gray-900">
                                                        <span v-for="val in 5">{{ val }}</span>
                                                    </div>
                                                    <InputError :message="formReview.errors.rating" class="mt-2"/>

                                                    <InputLabel for="review" class="mt-3" value="Komentar"/>
                                                    <TextAreaInput
                                                        id="review"
                                                        v-model="formReview.desc"
                                                        class="mt-1 block w-full"
                                                        rows="2"
                                                        required
                                                    />
                                                    <InputError :message="formReview.errors.desc" class="mt-2"/>

                                                    <PrimaryButton
                                                        as="button"
                                                        @click="storeReview"
                                                        class="mt-3"
                                                        :class="{ 'opacity-25': formReview.processing }"
                                                        :disabled="formReview.processing"
                                                    >
                                                        Kirim
                                                    </PrimaryButton>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-16 lg:col-span-7 lg:col-start-6 lg:mt-0">
                                            <div class="flow-root">
                                                <div class="">
                                                    <div v-for="review in props.course.review" :key="review.id"
                                                         class="py-5">
                                                        <div class="flex items-center">
                                                            <img :src="review.user.profile_photo_url" :alt="`${review.user.name}.`"
                                                                 class="h-12 w-12 rounded-full"/>
                                                            <div class="ml-4">
                                                                <h4 class="text-sm font-bold text-gray-900">{{ review.user.name }}</h4>
                                                                <div class="mt-1 flex items-center">
                                                                    <StarIcon v-for="rating in [0, 1, 2, 3, 4]"
                                                                              :key="rating"
                                                                              :class="[review.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']"
                                                                              aria-hidden="true"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-4 space-y-6 text-sm text-gray-600"
                                                             v-html="review.desc"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="mt-10 pt-10 flex items-center border-t border-gray-300">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="course.user.profile_photo_url" alt=""/>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">
                                <span class="hover:underline">{{ course.user.name }}</span>
                            </div>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <span>{{ course.user.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </CourseLayout>

</template>
