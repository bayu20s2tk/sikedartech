<script setup>
import InputError from "../../../Components/InputError.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import TextInput from "../../../Components/TextInput.vue";
import EditorInput from "../../../Components/EditorInput.vue";
import {router, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import DangerButton from "../../../Components/DangerButton.vue";
import ActionMessage from "../../../Components/ActionMessage.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import TextAreaInput from "../../../Components/TextAreaInput.vue";
import BlankButton from "../../../Components/BlankButton.vue";

const props = defineProps({
  item: Object,
  course_id: Number
});

const form = useForm({
  id: props.item.id,
  course_id: props.course_id,
  type_id: 2,
  name: props.item.name,
  content: props.item.content,
  link: props.item.link,
  media: null,
});
const updateContent = () => {
  // if (mediaInput.value) {
  //   form.media = mediaInput.value.files[0];
  // }

  form.put(route('courseItem.update', props.item), {
    errorBag: 'updateInformation',
    preserveScroll: true,
    onSuccess: () => {

    },
  });
};

const deleteContent = () => {
  form.delete(route('courseItem.destroy', props.item), {
    // errorBag: 'updateInformation',
    preserveScroll: true,
    onSuccess: () => {
      // form.reset()
    },
  });
};

const storePageMedia = () => {
  if (mediaInput.value) {
    form.media = mediaInput.value.files[0];
  }

  form.post(route('courseItem.addMedia'), {
    errorBag: 'storeMedia',
    preserveScroll: true,
    onSuccess: () => {
      mediaPreview.value = null;
      clearMediaFileInput();
      form.reset();
    },
  });
};

const deleteMedia = (courseItem, index) => {
  router.delete(route('courseItem.deleteMedia', index), {
    preserveScroll: true,
    onSuccess: () => {
      mediaPreview.value = null;
      clearMediaFileInput();
    },
  });
};
const edit = (item) => {
  form.reset()
  form.id = item.id
  form.name = item.name
  form.content = item.content
};

const mediaPreview = ref(null);
const mediaInput = ref(null);

const selectNewMedia = () => {
  mediaInput.value.click();
};

const updateMediaPreview = () => {
  const media = mediaInput.value.files[0];

  if (!media) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    mediaPreview.value = e.target.result;
  };

  reader.readAsDataURL(media);

  storePageMedia()
};

const clearMediaFileInput = () => {
  if (mediaInput.value?.value) {
    mediaInput.value.value = null;
  }
};
</script>

<template>
  <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg p-5">
    <div class=" ">
      <InputLabel value="Judul"/>
      <TextInput
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          autocomplete="name"
          required
      />
      <InputError :message="form.errors.name" class="mt-2"/>
    </div>

    <div class="">
      <InputLabel class="mb-1 mt-5" value="Deskripsi"/>

      <EditorInput
          v-model="form.content"
      />
      <InputError :message="form.errors.content" class="mt-2"/>
    </div>

    <div class=" ">
      <InputLabel class="mb-1 mt-5" value="Link"/>
      <TextInput
          v-model="form.link"
          type="text"
          class="mt-1 block w-full"
          placeholder="http://"
      />
      <InputError :message="form.errors.link" class="mt-2"/>
    </div>

    <div class="">
      <InputLabel class="mb-1 mt-5" value="Attachment" />

      <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-5">
        <template v-for="(media, index) in props.item.media">
          <div class="relative py-3 px-2 flex flex-col items-center justify-center border border-gray-300 rounded-3xl shadow-xl">
            <i class="fa-duotone fa-file text-gray-400 text-5xl"></i>
            <div class="text-center mt-2">
              <p class="block text-sm font-medium text-gray-900">{{ media.file_name }}</p>
              <a
                  type="button"
                  :href="media.original_url"
                  :download="media.file_name"
                  class="text-primary-600 text-xs font-semibold"
              >
                Download
              </a>
              <button class="text-red-600 text-xs font-semibold" @click.prevent="deleteMedia(props.item.id, media.id)">
                Delete
              </button>
            </div>
          </div>
        </template>

        <!-- Profile media -->
        <div class="">
          <!-- Profile media File Input -->
          <input
              ref="mediaInput"
              type="file"
              class="hidden"
              @change="updateMediaPreview"
          >

          <div class="block h-full">
            <button @click.prevent="selectNewMedia" type="button"
                    class="relative py-3 px-2 flex flex-col justify-center items-center w-full h-full text-center border-2 border-gray-400 border-dashed focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-2xl shadow-sm">
              <i class="fa-duotone fa-file text-gray-400 text-5xl"></i>
              <span class="mt-2 block text-sm font-medium text-gray-900">Tambah Media</span>
              <p class="text-gray-500 text-xs font-semibold" >
                * any extension
              </p>
            </button>
          </div>

          <InputError :message="form.errors.media" class="mt-2"/>
        </div>

      </div>
    </div>

    <div class="grid grid-cols-2 pt-5 mt-5 border-t border-gray-300">
      <div class="flex justify-start">
        <DangerButton
            @click="deleteContent"
            type="button"
            class="group"
        >
          <i class="fa-duotone fa-trash"/>
          <span class="ml-2 hidden group-hover:block">Hapus</span>
        </DangerButton>
      </div>
      <div class="flex items-center justify-end">
        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
          Berhasil disimpan.
        </ActionMessage>

        <PrimaryButton
            @click.prevent="updateContent"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing">
          Simpan
        </PrimaryButton>
      </div>
    </div>
  </div>
</template>
