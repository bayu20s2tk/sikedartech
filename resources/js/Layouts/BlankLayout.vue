<script setup>
import {computed, ref, useSlots, watch} from 'vue';
// import {Inertia} from '@inertiajs/inertia';
import {router, Head, Link} from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';

const props = defineProps({
  title: String,
  darkMode: Boolean,
  greeting: String,
  name: String,
  desc: String,
  avatar: String
});

const darkMode = ref(JSON.parse(localStorage.getItem('darkmode')) ?? false)

watch(darkMode, (newDarkMode) => {
  console.log(`darkmode is ${newDarkMode}`)
  localStorage.setItem('darkmode', JSON.stringify(newDarkMode))
})

const showingNavigationDropdown = ref(false);

const hasAction = computed(() => !! useSlots().action);
const hasPrevious = computed(() => !! useSlots().previous);

const logout = () => {
  router.post(route('logout'));
};
</script>

<template>
  <div class="transition duration-1000" :class="darkMode ? 'nightwind dark' : 'nightwind' ">
    <template v-if="$page.props.appSetting">
      <Head :title="title + ' - ' + $page.props.appSetting.name"/>
    </template>

    <template v-else>
      <Head :title="title"/>
    </template>

    <div class="sticky top-0 z-50">
      <Banner/>
    </div>

    <div class="min-h-screen bg-gray-100 bg-glass bg-fixed flex justify-center items-center">
      <slot/>
    </div>
  </div>

</template>
