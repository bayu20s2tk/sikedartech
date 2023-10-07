<script setup>
import {onBeforeUnmount, onMounted, onUnmounted, ref} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from "@/Components/TextAreaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
  course: Object | String,
});

const form = useForm({
  name: props.course.name ?? null,
  desc: props.course.desc ?? null,
  price: props.course.price ?? null,
  category_id: props.course.category_id ?? null,
  photo: null,
});

const storeInformation = () => {

  if (props.course.name == null) {
    form.post(route('course.store'), {
      errorBag: 'storeInformation',
      preserveScroll: true,
      onSuccess: () => showPage(),
    });
  } else {
    form.put(route('course.update', props.course), {
      errorBag: 'updateInformation',
      preserveScroll: true,
      onSuccess: () => showPage(),
    });
  }
};

const showPage = () => {

};


</script>

<template>
  <FormSection @submitted="storeInformation">
    <template #title>
      Informasi Course
    </template>

    <template #description>
      Update your account's profile information and email address.
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <InputLabel for="name" value="Judul"/>
        <TextInput
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            autocomplete="name"
            required
        />
        <InputError :message="form.errors.name" class="mt-2"/>
      </div>

      <div class="col-span-6 sm:col-span-5">
        <InputLabel for="desc" value="Deskripsi"/>
        <TextAreaInput
            id="desc"
            v-model="form.desc"
            class="mt-1 block w-full"
            rows="2"
            required
        />
        <InputError :message="form.errors.desc" class="mt-2"/>
      </div>

      <div class="col-span-3">
        <InputLabel for="fees" value="Harga" />
        <div class="flex">
          <span class="flex items-center bg-white text-black border border-gray-300 border-r-0 rounded-3xl rounded-r-none shadow-sm mt-1 px-3 ">
              Rp
          </span>
          <TextInput
              id="fees"
              v-model="form.price"
              type="number"
              class="mt-1 block w-full rounded-l-none"
          />
        </div>
        <InputError :message="form.errors.price" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-5">
        <InputLabel for="category" value="Kategori"/>
        <SelectInput
            id="category"
            v-model:model-value.number="form.category_id"
            :option="$page.props.selectCategory"
            class="mt-1 block w-full"
            required
        />
        <InputError :message="form.errors.category_id" class="mt-2"/>
      </div>
    </template>

    <template #actions>
      <ActionMessage :on="form.recentlySuccessful" class="mr-3">
        Berhasil disimpan.
      </ActionMessage>

      <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Simpan
      </PrimaryButton>
    </template>
  </FormSection>
</template>
