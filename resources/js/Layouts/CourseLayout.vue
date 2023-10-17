<script setup>
import {computed, ref, useSlots, watch} from 'vue';
// import {Inertia} from '@inertiajs/inertia';
import {router, Head, Link} from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLinkAlt from '@/Components/NavLinkAlt.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import DarkmodeToggle from "@/Components/DarkmodeToggle.vue";
import FlyoutMenu from "@/Components/FlyoutMenu.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverOverlay,
    PopoverPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import PreviousButton from "../Components/PreviousButton.vue";

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

const hasAction = computed(() => !!useSlots().action);
const hasPrevious = computed(() => !!useSlots().previous);

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

        <div class="min-h-screen bg-gray-100 bg-glass bg-fixed ">
            <!--           pb-24  bg-gradient-to-r from-primary-800 to-primary-400-->
            <Popover as="header" class="" v-slot="{ open }">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                    <div class="relative flex items-center justify-between lg:justify-between">
                        <!-- Logo -->
                        <div class=" py-5 flex-shrink-0 lg:static flex items-center">
                                <PreviousButton />
                        </div>

                        <!-- Right section on desktop -->
                        <div class="lg:ml-4 flex items-center lg:py-5 lg:pr-0.5">

                            <DarkmodeToggle :darkMode="darkMode" @click="darkMode = ! darkMode"/>

                            <!-- Profile dropdown -->
                            <Menu as="div" class="ml-4 relative flex-shrink-0">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-10 w-10 rounded-full object-cover"
                                                 :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-3xl">
                                        <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-3xl text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                            {{ $page.props.user.name }}

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path fill-rule="evenodd"
                                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('landing.welcome')">
                                            Beranda
                                        </DropdownLink>

                                        <DropdownLink :href="route('dashboard')">
                                            Dasbor
                                        </DropdownLink>

                                        <DropdownLink :href="route('profile.show')">
                                            Profil
                                        </DropdownLink>

                                        <div class="border-t border-gray-100"/>

                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Keluar
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </Menu>
                        </div>
                    </div>
                </div>

                <TransitionRoot as="template" :show="open">
                    <div class="lg:hidden">
                        <TransitionChild as="template" enter="duration-150 ease-out" enter-from="opacity-0"
                                         enter-to="opacity-100" leave="duration-150 ease-in" leave-from="opacity-100"
                                         leave-to="opacity-0">
                            <PopoverOverlay class="z-20 fixed inset-0 bg-black bg-opacity-50"/>
                        </TransitionChild>

                        <TransitionChild as="template" enter="duration-150 ease-out" enter-from="opacity-0 scale-95"
                                         enter-to="opacity-100 scale-100" leave="duration-150 ease-in"
                                         leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <PopoverPanel focus
                                          class="z-30 absolute top-0 inset-x-0 max-w-3xl mx-auto w-full p-2 transition transform origin-top">
                                <div
                                    class="rounded-3xl bg-white bg-opacity-50 backdrop-blur shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-200">
                                    <div class="pt-3 pb-2">
                                        <div class="flex items-center justify-between px-4">
                                            <div>
                                                <!--                                                <Link :href="route('dashboard')">-->
                                                <!--                                                    <ApplicationMark class="block h-9 w-auto"/>-->
                                                <!--                                                </Link>-->
                                                <DarkmodeToggle :darkMode="darkMode" @click="darkMode = ! darkMode"/>
                                            </div>

                                            <div class="-mr-2">
                                                <PopoverButton
                                                    class="bg-white rounded-3xl inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500">
                                                    <button
                                                        class="inline-flex items-center justify-center p-2 rounded-3xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                                        @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                                        <svg
                                                            class="h-6 w-6"
                                                            stroke="currentColor"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 6h16M4 12h16M4 18h16"
                                                            />
                                                            <path
                                                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M6 18L18 6M6 6l12 12"
                                                            />
                                                        </svg>
                                                    </button>
                                                </PopoverButton>
                                            </div>
                                        </div>
                                        <div class="mt-3 px-2 space-y-1">
                                            <!--                                            <ResponsiveNavLink :href="route('dashboard')"-->
                                            <!--                                                               :active="route().current('dashboard')">-->
                                            <!--                                                Dasbor-->
                                            <!--                                            </ResponsiveNavLink>-->

                                            <!--                                            <ResponsiveNavLink :href="route('user.index')"-->
                                            <!--                                                               :active="$page.url.startsWith('/user')"-->
                                            <!--                                                               v-if="$page.props.user.role_id==1">-->
                                            <!--                                                Pengguna-->
                                            <!--                                            </ResponsiveNavLink>-->

                                            <!--                                            <ResponsiveNavLink :href="route('setting.index')"-->
                                            <!--                                                               :active="$page.url.startsWith('/setting')"-->
                                            <!--                                                               v-if="$page.props.user.role_id==1">-->
                                            <!--                                                Pengaturan-->
                                            <!--                                            </ResponsiveNavLink>-->

                                        </div>
                                    </div>
                                    <div class="pt-4 pb-2">
                                        <div class="flex items-center px-5">
                                            <div class="flex-shrink-0">
                                                <img class="h-12 w-12 rounded-full object-cover"
                                                     :src="$page.props.user.profile_photo_url"
                                                     :alt="$page.props.user.name"/>
                                            </div>
                                            <div class="ml-3 min-w-0 flex-1">
                                                <div class="text-base font-medium text-gray-800 truncate capitalize">
                                                    {{ $page.props.user.name }}
                                                </div>
                                                <div class="text-sm font-medium text-gray-500 truncate">
                                                    {{ $page.props.user.email }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 px-2 space-y-1">

                                            <!--                                            <ResponsiveNavLink :href="route('landing.welcome')"-->
                                            <!--                                                               :active="route().current('landing.welcome')">-->
                                            <!--                                                Beranda-->
                                            <!--                                            </ResponsiveNavLink>-->

                                            <ResponsiveNavLink :href="route('profile.show')"
                                                               :active="route().current('profile.show')">
                                                Profil
                                            </ResponsiveNavLink>

                                            <!--                                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures"-->
                                            <!--                                                               :href="route('api-tokens.index')"-->
                                            <!--                                                               :active="route().current('api-tokens.index')">-->
                                            <!--                                                API Tokens-->
                                            <!--                                            </ResponsiveNavLink>-->

                                            <!-- Authentication -->
                                            <form method="POST" @submit.prevent="logout">
                                                <ResponsiveNavLink as="button">
                                                    Keluar
                                                </ResponsiveNavLink>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </PopoverPanel>
                        </TransitionChild>
                    </div>
                </TransitionRoot>
            </Popover>
            <!--            -mt-24 -->
            <main class=" ">
                <div class="relative max-w-3xl lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
                    <slot/>
                </div>
            </main>
            <footer>
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl mt-10">
                    <div class="py-10 block lg:hidden">

                    </div>
                    <div
                        class="border-t border-gray-300 py-5 text-sm text-gray-500 text-center sm:text-left hidden lg:block">
                        <span class="block sm:inline capitalize">&copy; 2023 {{ $page.props.appSetting?.name }}. </span>
                        <span class="block sm:inline">All rights reserved.</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

</template>
