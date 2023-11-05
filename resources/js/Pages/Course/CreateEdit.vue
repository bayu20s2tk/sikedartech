<script setup>
import {Link} from "@inertiajs/vue3";
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';

import UpdateInformationForm from "./Partials/UpdateInformationForm.vue";
import DeleteForm from "./Partials/DeleteForm.vue";
import UpdateContentForm from "./Partials/UpdateContentForm.vue";
import PreviousButton from "@/Components/PreviousButton.vue";
import UpdateHeroForm from "./Partials/UpdateHeroForm.vue";
import UpdateAboutForm from "./Partials/UpdateAboutForm.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";

</script>

<template>
  <AppLayout title="Kursus"
             name="Kursus"
             desc="lorem ipsum"
  >

    <template #previous>
      <PreviousButton/>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10">
        <div>
          <UpdateInformationForm :course="$page.props.course ?? '' "/>

          <SectionBorder/>
        </div>

        <template v-if="$page.props.course">
          <UpdateHeroForm :course="$page.props.course"/>

          <SectionBorder/>

          <!--                    <UpdateContentForm :course="$page.props.course" />-->

          <!--                    <SectionBorder />-->

          <UpdateAboutForm :course="$page.props.course"/>

          <!--                    <SectionBorder />-->

          <div class="relative py-8">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
              <div class="w-full border-t border-gray-300"/>
            </div>
            <div class="relative flex justify-center">
              <SecondaryButton
                  as="a"
                  class="bg-opacity-100"
                  :href="route('course.show', $page.props.course)"
              >
                <i class="fa-regular fa-paper-plane mr-2"/>
                Lihat kelas
              </SecondaryButton>
            </div>
          </div>

          <DeleteForm :course="$page.props.course"/>
        </template>
      </div>
    </div>
  </AppLayout>
</template>
