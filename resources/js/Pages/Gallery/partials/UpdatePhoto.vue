<script setup>
  import {Head, Link, router, useForm} from '@inertiajs/vue3';
  import AppLayout from "@/Layouts/AppLayout.vue";
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import {onMounted, ref} from "vue";
  import InputError from "@/Components/InputError.vue";
  import DangerButton from "@/Components/DangerButton.vue";
  import { toClipboard } from '@soerenmartius/vue3-clipboard';
  import Popper from "vue3-popper";

  // onMounted(() => {
  //   // console.log('history');
  //   router.reload({ only: ['gallery'] })
  // })

  const form = useForm({
    // id: props.blog.id,
    photo: null,
  });

  const photoPreview = ref(null);
  const photoInput = ref(null);

  const storePhoto = () => {
    console.log('halo')
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
</script>

<template>
  <ul role="list" class="grid sm:grid-cols-3 lg:grid-cols-4 gap-3 list-none">

    <template v-for="item in $page.props.gallery" :key="item.name">
      <li class="">
        <div class="relative">
          <img class="shadow-lg rounded-3xl w-full aspect-video object-cover" :src="item.media[0].original_url" alt="" />
          <div class="absolute bottom-0 left-0 right-0 flex justify-end">
<!--            <PrimaryButton-->
<!--                class="rounded-none py-4 bg-opacity-50 inline-flex rounded-bl-3xl rounded-tr-3xl"-->
<!--            >-->
<!--              <i class="fa-duotone fa-pen" />-->
<!--              <span class="ml-3">Copy</span>-->
<!--            </PrimaryButton>-->

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
