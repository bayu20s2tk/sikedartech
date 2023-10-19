<script setup>
import {Link, router} from "@inertiajs/vue3";
import moment from "moment";
import LandingLayout from "@/Layouts/LandingLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import Heading from "../../Components/Heading.vue";
import {onMounted} from "vue";

const props = defineProps({
    course: undefined,
});

onMounted(() => {
  router.reload({only: ['course']})
})

function formatPrice(value) {
    return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}
</script>

<template>
    <LandingLayout title="Course" desc="Lorem ipsum">
      <div class="pt-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <Heading>
            <template #header>
              Kelas
            </template>

            <template #desc>
              Belajar membangun website yang dinamis seperti toko online dengan teknologi web development terbaru
            </template>
          </Heading>

          <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
<!--            <template v-if="props.course===undefined">-->
<!--              <div class="animate-pulse bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">-->
<!--                <div class="h-72 w-full overflow-hidden rounded-t-3xl">-->
<!--                  <div class="rounded-t-3xl h-full w-full object-cover object-center"/>-->
<!--                </div>-->
<!--                <div class="py-3 px-5 items-end">-->
<!--                  <h3 class="text-lg font-semibold text-gray-900">0</h3>-->
<!--                  &lt;!&ndash;                <p class="mt-1 text-sm text-gray-500">{{ item.desc }}</p>&ndash;&gt;-->
<!--                  <p class="mt-1 text-sm text-gray-500">Rp 0</p>-->
<!--                </div>-->
<!--              </div>-->
<!--            </template>-->
            <div v-for="item in props.course" :key="item.id">
              <Link :href="route('landing.course.show', item)">
                <div class="bg-white bg-opacity-50 h-full border border-gray-300 rounded-3xl shadow-lg">
                  <div class="h-52 w-full overflow-hidden rounded-t-3xl">
                    <img :src="item.media[0]?.original_url" :alt="item.name"
                         class="rounded-t-3xl h-full w-full object-cover object-center"/>
                  </div>
                  <div class="py-3 px-5 items-end">
                    <h3 class="text-lg font-semibold text-gray-900">{{ item.name }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ item.desc }}</p>
                    <p class="mt-1 text-sm font-semibold text-gray-700">
                        <template v-if="item.has_subscribed">
                            <i class="fa-duotone fa-circle-check text-green-600 mr-1" /> Akses selamanya
                        </template>
                        <template v-else>
                            Rp {{ formatPrice(item.price) }}
                        </template>
                    </p>
                  </div>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </LandingLayout>

</template>
