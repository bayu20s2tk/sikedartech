<script setup>
import {ref, watch} from "vue";
import {Link, useForm, router} from "@inertiajs/vue3";
import MobileMenu from "@/Components/MobileMenu.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import moment from "moment";
import {Vue3Lottie} from "vue3-lottie";
import BlankLayout from "@/Layouts/BlankLayout.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const props = defineProps({
  // users: Object,
  // carousel: Object,
})



function formattedDate(value) {
  return moment(value).format('DD MMM Y HH:m')
}

function formatPrice(value) {
  let val = (value / 1).toFixed(0).replace('.', '')
  return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

</script>

<template>
  <BlankLayout title="Upgrade">
    <div class="relative isolate overflow-hidden">
      <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
        <defs>
          <pattern id="0787a7c5-978c-4f66-83c7-11c213f99cb7" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
            <path d="M.5 200V.5H200" fill="none"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" stroke-width="0" fill="url(#0787a7c5-978c-4f66-83c7-11c213f99cb7)"/>
      </svg>
      <div class="mx-auto max-w-7xl px-6 pt-10 pb-24 sm:pb-32 lg:flex lg:py-40 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
          <ApplicationLogo />
          <div class="mt-24 sm:mt-32 lg:mt-16">
            <a href="#" class="inline-flex space-x-6">
              <span class="rounded-full bg-primary-600 bg-opacity-20 px-3 py-1 text-sm font-semibold leading-6 text-primary-600 ring-1 ring-inset ring-primary-600/10">Dolor sit</span>
              <span class="inline-flex items-center space-x-2 text-sm font-medium leading-6 text-gray-600">
                <span>Lorem ipsum</span>
                  <i class="fa-regular fa-angle-right text-gray-400"/>
              </span>
            </a>
          </div>
          <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Project Saved for Verification</h1>
          <p class="mt-6 text-lg leading-8 text-gray-600">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
            industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
            scrambled it to make a type specimen book
          </p>
          <div class="mt-10 flex items-center gap-x-5">
            <PrimaryButton as="a" :href="route('project.index')">Kembali</PrimaryButton>
            <!--                        <SecondaryButton >Lorem</SecondaryButton>-->
          </div>
        </div>
        <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mt-0 lg:mr-0 lg:max-w-none lg:flex-none xl:ml-32">
          <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
            <div class="-m-2 rounded-3xl bg-gray-900 bg-opacity-10 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:p-4">
              <img src="https://tailwindui.com/img/component-images/project-app-screenshot.png"
                   alt="App screenshot" width="2432" height="1442"
                   class="w-[76rem] rounded-3xl shadow-2xl ring-1 ring-gray-900 ring-opacity-10"/>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--        <MobileMenu/>-->
  </BlankLayout>
</template>
