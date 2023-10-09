<script setup>
import {onMounted, ref, watch} from 'vue';
import {Editor, EditorContent, useEditor} from '@tiptap/vue-3'
import Document from "@tiptap/extension-document";
import Heading from "@tiptap/extension-heading";
import Paragraph from "@tiptap/extension-paragraph"
import Text from "@tiptap/extension-text"
import GroupButton from "@/Components/GroupButton.vue";
import GroupButtonLink from "@/Components/GroupButtonLink.vue";
import StarterKit from "@tiptap/starter-kit";
import Image from '@tiptap/extension-image';
import DialogModal from "./DialogModal.vue";
import 'tippy.js/dist/tippy.css';
import {router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "./PrimaryButton.vue";
import DangerButton from "./DangerButton.vue";
import InputError from "./InputError.vue";
import {Youtube} from "@tiptap/extension-youtube";
import {CodeBlock} from "@tiptap/extension-code-block";

const props = defineProps({
    modelValue: {
        type: String,
        default: '',
    },
    gallery: Object
});

onMounted(() => {
    router.reload({only: ['modelValue']})
})

const editor = useEditor({
    editorProps: {
        attributes: {
            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl p-3 mt-3 focus:outline-none bg-white border border-gray-300 focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-3xl shadow-sm',
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
                class: ' rounded-3xl ',
            },
        }),
        Youtube.configure({
            inline: false,
            ccLanguage: 'id',
            interfaceLanguage: 'id',
            enableIFrameApi: 'true',
            modestBranding: 'true',
            HTMLAttributes: {
                class: 'w-full rounded-3xl ',
            },
        }),
        // CodeBlock.configure({
        //     languageClassPrefix: 'language-',
        //     HTMLAttributes: {
        //         class: 'w-full rounded-3xl',
        //     },
        // })

    ],
    onUpdate: ({editor}) => {
        let content = editor.getHTML()
        emit('update:modelValue', content)
    },
    content: props.modelValue
})

const emit = defineEmits(['update:modelValue']);

watch(() => props.modelValue, (newValue, oldValue) => {
    const isSame = newValue === oldValue
    // console.log(`Same: ${isSame}`)
    if (isSame) {
        return
    }
    editor.value.commands.setContent(newValue, false,  {preserveWhitespace: "full"})
})

const form = useForm({
  // id: props.blog.id,
  photo: null,
});

const photoPreview = ref(null);
const photoInput = ref(null);

const storePhoto = () => {
  // console.log('halo')
  if (photoInput.value) {
    form.photo = photoInput.value.files[0];
  }

  form.post(route('gallery.store'), {
    errorBag: 'storeInformation',
    preserveScroll: true,
    onSuccess: () => {
      photoPreview.value = null;
      clearPhotoFileInput();
      form.reset();
    },
  });
};

const selectNewPhoto = () => {
  photoInput.value.click();
};

const updatePhotoPreview = () => {
  const photo = photoInput.value.files[0];

  if (!photo) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    photoPreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);

  storePhoto()
};

const deletePhoto = (item) => {
  router.delete(route('gallery.destroy', item), {
    preserveScroll: true,
    onSuccess: () => {
      photoPreview.value = null;
      clearPhotoFileInput();
    },
  });
};

const clearPhotoFileInput = () => {
  if (photoInput.value?.value) {
    photoInput.value.value = null;
  }
};

function addImage(img) {
  editor.value.chain().focus().setImage({ src: img }).run()
  galleryModal.value=false
}

function addYoutube() {
    const url = prompt('Enter YouTube URL')

    editor.value.commands.setYoutubeVideo({
        src: url,
        // width: Math.max(320, parseInt(this.width, 10)) || 640,
        // height: Math.max(180, parseInt(this.height, 10)) || 480,
    })
}

const galleryModal = ref(false);
const closeModal = () => {
    galleryModal.value = false;
    // form.reset();
};

</script>

<template>
    <GroupButton>
        <GroupButtonLink @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" class="rounded-l-3xl">H1</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" >H2</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" >H3</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" >H4</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" >H5</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().setParagraph().run()" class="rounded-r-3xl mr-2" >P</GroupButtonLink>

        <GroupButtonLink @click="galleryModal=true" class="rounded-l-3xl rounded">Image</GroupButtonLink>
        <GroupButtonLink @click="addYoutube">Youtube</GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleCodeBlock().run()" class="rounded-r-3xl mr-2">Code</GroupButtonLink>

        <GroupButtonLink @click="editor.chain().focus().toggleItalic().run()" class="rounded-l-3xl"><i>Italic</i></GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleBold().run()"><b>Bold</b></GroupButtonLink>
        <GroupButtonLink @click="editor.chain().focus().toggleBulletList().run()" class="rounded-r-3xl mr-2">List</GroupButtonLink>

        <!--        <GroupButtonLink @click="editor.chain().focus().undo().run()" class="rounded-l-2xl" :disabled="!editor.can().chain().focus().undo().run()">undo</GroupButtonLink>-->
        <!--        <GroupButtonLink @click="editor.chain().focus().redo().run()" class="rounded&#45;&#45;2xl" :disabled="!editor.can().chain().focus().redo().run()">redo</GroupButtonLink>-->
    </GroupButton>

    <EditorContent
        ref="input"
        @input="$emit('update:modelValue', $event.target.value)"
        :editor="editor"
        required
    />

    <DialogModal max-width="7xl" :show="galleryModal" @close="closeModal">
        <template #title>
            Tambah Image
        </template>

        <template #content>
          Klik foto

          <ul role="list" class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 list-none mt-5">

            <template v-for="item in $page.props.gallery" :key="item.name">
              <li class="">
                <div class="relative">
                  <img class="shadow-lg rounded-3xl w-full aspect-video object-cover" :src="item.media[0].original_url" alt="" />
                  <div class="absolute bottom-0 left-0 right-0 flex justify-between">
                    <PrimaryButton
                        class="rounded-none py-4 bg-opacity-50 inline-flex rounded-bl-3xl rounded-tr-3xl"
                        @click="addImage(item.media[0].original_url)"
                    >
                      <i class="fa-duotone fa-pen" />
                      <span class="ml-3">Pilih</span>
                    </PrimaryButton>

                    <DangerButton
                        @click.prevent="deletePhoto(item.id)"
                        class="rounded-none py-4 bg-opacity-50 inline-flex rounded-br-3xl rounded-tl-3xl"
                    >
                      <i class="fa-duotone fa-trash" />
                      <span class="ml-3">Hapus</span>
                    </DangerButton>
                  </div>
                </div>
              </li>
            </template>

            <li class="">
              <input
                  ref="photoInput"
                  type="file"
                  class="hidden"
                  @change="updatePhotoPreview"
              >

              <div class="block ">
                <div v-if="photoPreview" class="" @click.prevent="selectNewPhoto">
                    <span
                        class="block rounded-3xl w-full aspect-video px-2 bg-cover bg-no-repeat bg-center border border-gray-300"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <button v-else
                        @click.prevent="selectNewPhoto" type="button"
                        class="relative block w-full aspect-video p-12 text-center border-2 border-gray-400 border-dashed focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 rounded-3xl shadow-sm"
                >
                  <i class="fa-duotone fa-image text-gray-400 text-5xl"></i>
                  <span class="mt-2 block text-sm font-medium text-gray-900">Tambah Foto</span>
                </button>
              </div>

              <!--              <PrimaryButton-->
              <!--                  class="mt-2 mr-2"-->
              <!--                  type="button"-->
              <!--                  :class="{ 'opacity-25': form.processing }"-->
              <!--                  :disabled="form.processing"-->
              <!--                  @click="storePhoto"-->
              <!--              >-->
              <!--                  Simpan Foto-->
              <!--              </PrimaryButton>-->

              <InputError :message="form.errors.photo" class="mt-2"/>
            </li>
          </ul>
        </template>

        <template #footer>
            Lorem ipsum
        </template>
    </DialogModal>
</template>
