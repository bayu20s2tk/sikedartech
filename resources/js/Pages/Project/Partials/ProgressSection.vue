<script setup>
import {useForm} from "@inertiajs/vue3";
import InputLabel from "../../../Components/InputLabel.vue";
import TextAreaInput from "../../../Components/TextAreaInput.vue";
import InputError from "../../../Components/InputError.vue";
import {ChatBubbleLeftEllipsisIcon, TagIcon, UserCircleIcon} from '@heroicons/vue/20/solid'
import ActionSection from "../../../Components/ActionSection.vue";
import DangerButton from "../../../Components/DangerButton.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import SectionTitle from "../../../Components/SectionTitle.vue";
import moment from "moment/moment";

const props = defineProps({
  project: Object
});

const form = useForm({
  project_id: props.project.id,
  range: null,
  desc: null,
});

const storeInformation = () => {

  form.post(route('projectProgress.store'), {
    errorBag: 'storeInformation',
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    },
  });
};

function formattedDate(value) {
  return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
  <ActionSection>
    <template #title>
      Buat Progress
    </template>

    <template #description>
      Hapus proyek secara permanen
    </template>

    <template #content>
      <InputLabel for="steps-range" value="Range"/>
      <input
          id="steps-range"
          type="range"
          min="0"
          max="100"
          step="10"
          v-model="form.range"
          class="w-full h-2 bg-primary-400 rounded-full appearance-none cursor-pointer">

      <div class="w-full flex justify-between text-xs px-2 text-gray-900">
        <span v-for="val in 11">{{ val - 1 }}</span>
      </div>

      <div class="col-span-6 sm:col-span-4 mt-10">
        <InputLabel for="desc" value="Deskripsi"/>
        <TextAreaInput
            id="desc"
            v-model="form.desc"
            type="text"
            class="mt-1 block w-full"
            rows="2"
            required
        />
        <InputError :message="form.errors.desc" class="mt-2"/>
      </div>

      <div class="mt-5">
        <PrimaryButton class="" @click="storeInformation">
          Simpan
        </PrimaryButton>
      </div>

    </template>
  </ActionSection>

  <div class="md:grid md:grid-cols-4 md:gap-6 mb-10 sm:mt-0">
    <SectionTitle class="pl-3">
      <template #title>
        Riwayat Progress
      </template>
      <template #description>
        Lorem ipsum
      </template>
    </SectionTitle>

    <div class="mt-5 md:mt-0 md:col-span-3">
      <div class="flow-root px-4 py-5 sm:p-6 ">
        <ul role="list" class="-mb-8">
          <li v-for="(activityItem, activityItemIdx) in props.project.progress" :key="activityItem.id">
            <div class="relative pb-8">
              <span v-if="activityItemIdx !== props.project.progress.length - 1"
                    class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-300" aria-hidden="true"/>
              <div class="relative flex items-start space-x-3">
                <div class="relative">
                  <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-1 ring-gray-300"
                       :src="activityItem.user.profile_photo_url" alt=""/>
                  <span class="absolute -bottom-0.5 -right-1 rounded-tl px-0.5 py-px">
                    <i class="fa-duotone fa-message text-gray-600"/>
                  </span>
                </div>
                <div class="min-w-0 flex-1">
                  <div>
                    <div class="text-md">
                      <p class="font-medium text-gray-900">{{ activityItem.user.name }}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">{{ formattedDate(activityItem.created_at) }}</p>
                  </div>
                  <div class="mt-2 text-sm text-gray-700">
                    <p>{{ activityItem.desc }}</p>
                  </div>
                  <div class="w-32 mt-2">
                    <div class="flex justify-between mb-1">
                      <span class="text-sm text-primary-700">Progress</span>
                      <span class="text-sm font-medium text-primary-700">{{ activityItem.range }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                      <div class="bg-blue-600 h-2.5 rounded-full" :style="{ 'width': activityItem.range + '%' }" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>


</template>
