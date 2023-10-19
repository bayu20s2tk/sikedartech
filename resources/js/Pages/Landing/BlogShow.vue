<script setup>
import LandingLayout from "@/Layouts/LandingLayout.vue";
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

const props = defineProps({
    blog: Object,
});

const editor = useEditor({
    content: props.blog.content,
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

const tab = ref(1)

const form = useForm({
    id: null,
    comment: null,
    blog_id: props.blog.id,
});

const storeInformation = () => {
    console.log(form.comment);
    // if (props.blog.name == null) {
        form.post(route('blogComment.store'), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => {
                form.reset()
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

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

</script>

<template>

    <LandingLayout :title="props.blog.name">

        <div class="relative overflow-hidden py-16">
          <div class="relative px-6 lg:px-8">
            <div class="mx-auto max-w-prose text-center text-lg mt-20">
                <h1>
                    <span class="block text-lg font-semibold text-indigo-600"><i class="fa-regular mr-2" :class="blog.category.icon" />{{ props.blog.category.name }}</span>
                    <span class="mt-2 block text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ props.blog.name }}</span>
                </h1>
<!--                    <p class="mt-8 text-lg leading-8 text-gray-500">Aliquet nec orci mattis amet quisque ullamcorper neque, nibh sem. At arcu, sit dui mi, nibh dui, diam eget aliquam. Quisque id at vitae feugiat egestas ac. Diam nulla orci at in viverra scelerisque eget. Eleifend egestas fringilla sapien.</p>-->
            </div>
            <div class="prose prose-2xl prose-indigo mx-auto mt-6 ">
                <EditorContent :editor="editor" />

            </div>

            <div class="max-w-4xl mx-auto border-t border-gray-300 mt-10 pt-10">
              <div class="border-b border-gray-300">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                  <button @click="tab=1"
                          :class="[tab==1 ?
                                          'border-primary-500 text-primary-600' :
                                          'border-gray-300 text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                          'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"
                  >
                    Komentar
                  </button>
                  <button @click="tab=2"
                          :class="[tab==2 ?
                                          'border-primary-500 text-primary-600' :
                                          'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                          'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"
                  >
                    Author
                  </button>
                </nav>

                <div class="my-5 " >
                  <template v-if="tab==1">
                    <div class="mb-10" v-if="$page.props.user">
                      <InputLabel for="desc" class="ml-2" value="Beri Komentar" />
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
                      <InputError :message="form.errors.comment" class="mt-2" />
                    </div>

                    <div class="">
                      <template v-for="(comment, commentIdx) in props.blog.comment" :key="comment.id">
                        <CommentSection
                            :blog_id="props.blog.id"
                            :comment="comment"
                            :comment_idx="commentIdx"
                        />

                      </template>
                    </div>
                  </template>
                  <template v-else-if="tab==2">
                    <div class="flex items-center">
                      <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt="" />
                      </div>
                      <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900">
                          <span class="hover:underline">
                              {{ blog.user.name }}
                          </span>
                        </div>
                        <div class="flex space-x-1 text-sm text-gray-500">
                          <span>
                              {{ blog.user.email }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </div>
            </div>
          </div>

        </div>



<!--        <div class="relative pb-10 pt-32">-->
<!--            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">-->
<!--                <div class="relative sm:py-16 lg:py-0">-->
<!--                    <div aria-hidden="true" class="hidden sm:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-screen">-->
<!--&lt;!&ndash;                        <div class="absolute inset-y-0 right-1/2 w-full bg-primary-500 rounded-r-2xl lg:right-72" />&ndash;&gt;-->
<!--                        <svg class="absolute top-8 left-1/2 -ml-3 lg:-right-8 lg:left-auto lg:top-12" width="404" height="392" fill="none" viewBox="0 0 404 392">-->
<!--                            <defs>-->
<!--                                <pattern id="02f20b47-fd69-4224-a62a-4c9de5c763f7" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">-->
<!--                                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />-->
<!--                                </pattern>-->
<!--                            </defs>-->
<!--                            <rect width="404" height="392" fill="url(#02f20b47-fd69-4224-a62a-4c9de5c763f7)" />-->
<!--                        </svg>-->
<!--                    </div>-->
<!--                    <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0 lg:max-w-none lg:py-20">-->
<!--                        <Carousel v-if="blog.media[0]" :items-to-show="1" :wrap-around="true" :transition="1000" :autoplay="5000">-->
<!--                            <template #slides>-->
<!--                                <Slide v-for="media in blog.media" :key="media.id">-->
<!--                                    <div class="carousel__item w-full aspect-square rounded-2xl relative">-->
<!--                                        <img class="object-cover w-full aspect-square rounded-2xl" :src="media.original_url">-->
<!--                                    </div>-->
<!--                                </Slide>-->
<!--                            </template>-->
<!--                            <template #addons>-->
<!--&lt;!&ndash;                                        <Navigation />&ndash;&gt;-->
<!--                                    <Pagination/>-->
<!--                            </template>-->
<!--                        </Carousel>-->

<!--                        <div class=" mt-10">-->
<!--                            <div class="border-b border-gray-300">-->
<!--                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">-->
<!--                                    <button @click="tab=1"-->
<!--                                            :class="[tab==1 ?-->
<!--                                                'border-primary-500 text-primary-600' :-->
<!--                                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',-->
<!--                                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"-->
<!--                                    >-->
<!--                                        Komentar-->
<!--                                    </button>-->
<!--                                    <button @click="tab=2"-->
<!--                                            :class="[tab==2 ?-->
<!--                                                'border-primary-500 text-primary-600' :-->
<!--                                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',-->
<!--                                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm']"-->
<!--                                    >-->
<!--                                        Lorem ipsum-->
<!--                                    </button>-->
<!--                                </nav>-->

<!--                                <div class="my-5" >-->
<!--                                    <template v-if="tab==1">-->
<!--                                        <div class="mb-10" v-if="$page.props.user">-->
<!--                                            <InputLabel for="desc" class="ml-2" value="Beri Komentar" />-->
<!--                                            <TextAreaInput-->
<!--                                                id="comment"-->
<!--                                                v-model="form.comment"-->
<!--                                                class="mt-1 block w-full"-->
<!--                                                rows="2"-->
<!--                                                required-->
<!--                                            />-->
<!--                                            <PrimaryButton-->
<!--                                                as="button"-->
<!--                                                @click="storeInformation"-->
<!--                                                class="mt-3"-->
<!--                                                :class="{ 'opacity-25': form.processing }"-->
<!--                                                :disabled="form.processing"-->
<!--                                            >-->
<!--                                                Kirim-->
<!--                                            </PrimaryButton>-->
<!--                                            <InputError :message="form.errors.comment" class="mt-2" />-->
<!--                                        </div>-->

<!--                                        <div class="">-->
<!--                                            <template v-for="(comment, commentIdx) in props.blog.comment" :key="comment.id">-->
<!--                                                <CommentSection-->
<!--                                                    :blog_id="props.blog.id"-->
<!--                                                    :comment="comment"-->
<!--                                                    :comment_idx="commentIdx"-->
<!--                                                />-->

<!--                                            </template>-->
<!--                                        </div>-->
<!--                                    </template>-->

<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0">-->
<!--                    &lt;!&ndash; Content area &ndash;&gt;-->
<!--                    <div class="pt-12 sm:pt-16 lg:pt-20">-->
<!--                        <h2 class="text-3xl text-gray-900 font-extrabold tracking-tight sm:text-4xl">{{ blog.name }}</h2>-->
<!--                        <div class="mt-3 text-gray-500 space-y-6">-->
<!--                            <p class="text-primary-500"><i class="fa-regular mr-2" :class="blog.category.icon" />{{ blog.category.name }}</p>-->

<!--                            <EditorContent-->
<!--                                :editor="editor"-->
<!--                                required />-->

<!--                        </div>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Stats section &ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="mt-10">&ndash;&gt;-->
<!--&lt;!&ndash;                        <dl class="grid grid-cols-2 gap-x-4 gap-y-8">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div v-for="stat in stats" :key="stat.label" class="border-t-2 border-gray-300 pt-6">&ndash;&gt;-->
<!--&lt;!&ndash;                                <dt class="text-base font-medium text-gray-500">{{ stat.label }}</dt>&ndash;&gt;-->
<!--&lt;!&ndash;                                <dd class="text-3xl font-extrabold tracking-tight text-gray-900">{{ stat.value }}</dd>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </dl>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->

<!--                    <div class="mt-10 pt-10 flex items-center border-t border-gray-300">-->
<!--                        <div class="flex-shrink-0">-->
<!--                            <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt="" />-->
<!--                        </div>-->
<!--                        <div class="ml-3">-->
<!--                            <div class="text-sm font-medium text-gray-900">-->
<!--                                <span class="hover:underline">-->
<!--                                    {{ blog.user.name }}-->
<!--                                </span>-->
<!--                            </div>-->
<!--                            <div class="flex space-x-1 text-sm text-gray-500">-->
<!--                                <span>-->
<!--                                    {{ blog.user.email }}-->
<!--                                </span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


    </LandingLayout>

</template>
