<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
import {Link} from "@inertiajs/vue3";
import {Editor, EditorContent, useEditor} from '@tiptap/vue-3'
import StarterKit from "@tiptap/starter-kit";
import Image from '@tiptap/extension-image';
import 'tippy.js/dist/tippy.css'; // optional for styling
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import InputError from "@/Components/InputError.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CommentSection from "@/Components/CommentSection.vue";
import Heading from "@/Components/Heading.vue";

const props = defineProps({
    project: Object,
    comment: Object
});

const editor = useEditor({
    content: props.project.content,
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

const projectTab = ref(0)
const tab = ref(1)

const form = useForm({
    id: null,
    comment: null,
    project_id: props.project.id,
});

const storeInformation = () => {
    // if (props.project.name == null) {
    form.post(route('projectComment.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
        },
    });
    // } else {
    //     form.put(route('project.update', props.project), {
    //         errorBag: 'updateInformation',
    //         preserveScroll: true,
    //         onSuccess: () => showPage(),
    //     });
    // }
};

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>

    <LandingLayout :title="props.project.name">

        <div class="relative pb-10 pt-32">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:items-start">
                <div class="px-4 sm:px-6 lg:px-0">
                    <Heading >
                        <template #header>
                            <p class="text-lg text-primary-500 font-medium">
                                <i class="fa-regular mr-2" :class="project.category.icon"/>
                                {{ project.category.name }}
                            </p>
                            {{ props.project.name }}
                        </template>
                        <template #desc>
                            {{ project.desc }}
                        </template>
                    </Heading>
                </div>

                <div class="relative mx-auto grid lg:grid-cols-6 gap-10 px-4 sm:px-6 lg:px-0">
                    <!-- Content area -->
                    <div class="lg:col-span-2">
<!--                        <h2 class="text-3xl text-gray-900 font-extrabold tracking-tight sm:text-4xl">-->
<!--                            {{ project.name }}-->
<!--                        </h2>-->
                        <div class="mt-3 text-gray-500 space-y-6">
<!--                            <p class="text-primary-500 font-medium">-->
<!--                                <i class="fa-regular mr-2" :class="project.category.icon"/>-->
<!--                                {{ project.category.name }}-->
<!--                            </p>-->

<!--                            <p class="text-gray-700">-->
<!--                                {{ project.desc }}-->
<!--                            </p>-->

                            <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                                <div class="px-3 py-5 grid gap-3 ">
                                    <h3 class="font-semibold text-gray-900 ml-2">
                                        {{ props.project.item.length ?? '0' }} lesson
                                    </h3>

                                    <template v-for="(list, listIdx) in props.project.item" :key="list.id">
                                        <button @click="projectTab=listIdx">
                                            <div
                                                class="rounded-3xl py-3 px-5 text-left"
                                                :class="projectTab==listIdx ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
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

                    <div class="lg:col-span-4 py-3 ">
                        <template v-for="(item, itemIdx) in props.project.item">
                            <div v-if="projectTab==itemIdx" class="">
<!--                                <h3 class="text-gray-900 font-semibold text-xl mb-5" v-html="item.name" />-->
                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="item.content" />
                            </div>
                        </template>
                    </div>

<!--                      <EditorContent-->
<!--                          :editor="editor"-->
<!--                          required/>-->

<!--                    <Carousel -->
<!--                        v-if="project.media[0]" -->
<!--                        :items-to-show="1" -->
<!--                        :wrap-around="true" -->
<!--                        :transition="1000"-->
<!--                        :autoplay="5000"-->
<!--                    >-->
<!--                        <template #slides>-->
<!--                            <Slide v-for="media in project.media" :key="media.id">-->
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
<!--                            <button @click="tab=3"-->
<!--                                    :class="[tab==3 ?-->
<!--                                    'border-primary-500 text-primary-600' :-->
<!--                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',-->
<!--                                    'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"-->
<!--                            >-->
<!--                                Review-->
<!--                            </button>-->
                        </nav>

                        <div class="my-5 prose prose-sm">
                            <template v-if="tab==1">
                                <p class="prose prose-sm lg:prose-lg xl:prose-2xl" v-html="props.project.about" />
                            </template>
                            <template v-else-if="tab==2">
                                <div class="mb-10" v-if="$page.props.user">
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

                                <div class="">
                                    <template v-for="(comment, commentIdx) in props.comment"
                                              :key="comment.id">
                                        <CommentSection
                                            :project_id="props.project.id"
                                            :comment="comment"
                                            :comment_idx="commentIdx"
                                        />
                                    </template>
                                </div>
                            </template>
<!--                            <template v-else-if="tab==3">-->
<!--                                &lt;!&ndash; Stats section &ndash;&gt;-->
<!--                                <div class="mt-10">-->
<!--                                    <dl class="grid grid-cols-2 gap-x-4 gap-y-8">-->
<!--                                        <div class="pt-6">-->
<!--                                            <dt class="text-base font-medium text-gray-500">Hahahaha</dt>-->
<!--                                            <dd class="text-3xl font-extrabold tracking-tight text-gray-900">Lorem ipsum</dd>-->
<!--                                        </div>-->
<!--                                    </dl>-->
<!--                                </div>-->
<!--                            </template>-->
                        </div>
                    </div>



                    <div class="mt-10 pt-10 flex items-center border-t border-gray-300">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" :src="project.user.profile_photo_url" alt=""/>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">
                                <span class="hover:underline">{{ project.user.name }}</span>
                            </div>
                            <div class="flex space-x-1 text-sm text-gray-500">
                                <span>{{ project.user.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </LandingLayout>

</template>
