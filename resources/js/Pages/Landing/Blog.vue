<script setup>
import {Link, router} from "@inertiajs/vue3";
import moment from "moment";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import Heading from "../../Components/Heading.vue";
import {onMounted} from "vue";

const props = defineProps({
    blog: Object,
});

onMounted(() => {
  router.reload({only: ['blog']})
})

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <LandingLayout title="Blog" desc="Lorem ipsum">

      <div class="pt-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <Heading>
            <template #header>
              Artikel
            </template>
            <template #desc>
              Belajar membangun website yang dinamis seperti toko online dengan teknologi web development terbaru
            </template>
          </Heading>

          <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3 xl:gap-x-8">
            <div v-for="blog in props.blog" :key="blog.name">
              <div>
                <Link :href="route('blog.show', blog)" class="inline-block">
                <span
                    :class="['bg-primary-300 text-primary-900', 'inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium']">
                  {{ blog.category.name }}
                </span>
                </Link>
              </div>
              <Link :href="route('blog.show', blog)" class="mt-4 block">
                <p class="text-xl font-semibold text-gray-900">{{ blog.name }}</p>
                <p class="mt-3 text-base text-gray-500">{{ blog.desc }}</p>
              </Link>
              <div class="mt-6 flex items-center">
                <div class="flex-shrink-0">
                  <Link :href="route('user.show', blog.user)">
                    <img class="h-10 w-10 rounded-full" :src="blog.user.profile_photo_url" alt=""/>
                  </Link>
                </div>
                <div class="ml-3">
                  <p class="text-sm font-medium text-gray-900">
                    <Link :href="route('user.show', blog.user)">{{ blog.user.name }}</Link>
                  </p>
                  <div class="flex space-x-1 text-sm text-gray-500">
                    <time :datetime="formattedDate(blog.created_at)">{{ formattedDate(blog.created_at) }}</time>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </LandingLayout>

</template>
