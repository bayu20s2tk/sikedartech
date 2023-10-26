<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="rounded-t-3xl bg-white bg-opacity-50 backdrop-blur border-t border-gray-300 overflow-hidden shadow-lg fixed bottom-0 right-0 left-0 lg:hidden z-40">
        <div class="pt-3 pb-2">
            <div class="flex justify-around max-w-7xl mx-auto">
                <Link :href="route('dashboard')" class="group text-center">
                    <i class="fa-home text-xl text-gray-700"
                       :class="$page.component.startsWith('Dashboard') ? 'fa-solid text-primary-700' : 'fa-regular' "
                    />
                    <h3 class="text-sm text-gray-700"
                        :class="$page.component.startsWith('Dashboard') ? 'font-semibold text-primary-700' : '' ">
                        Dasbor
                    </h3>
                </Link>

                <Link :href="route('course.index')" class="group text-center">
                    <i class="fa-book text-xl text-gray-700"
                       :class="$page.component.startsWith('Course/') ? 'fa-solid text-primary-700' : 'fa-regular' "
                    />
                    <h3 class="text-sm text-gray-700"
                        :class="$page.component.startsWith('Course/') ? 'font-semibold text-primary-700' : '' " >
                        Kelas
                    </h3>
                </Link>

                <Link :href="route('project.index')" class="group text-center">
                    <i class="fa-umbrella-beach text-xl text-gray-700"
                       :class="$page.component.startsWith('Project/') ? 'fa-solid text-primary-700' : 'fa-regular' "
                    />
                    <h3 class="text-sm text-gray-700"
                        :class="$page.component.startsWith('Project/') ? 'font-semibold text-primary-700' : '' " >
                        Proyek
                    </h3>
                </Link>

                <Link :href="route('blog.index')" class="group text-center" v-if="$page.props.user.role_id==1">
                    <i class="fa-blog text-xl text-gray-700"
                       :class="$page.component.startsWith('Blog/') ? 'fa-solid text-primary-700' : 'fa-regular' "
                    />
                    <h3 class="text-sm text-gray-700"
                        :class="$page.component.startsWith('Blog/') ? 'font-semibold text-primary-700' : '' " >
                        Artikel
                    </h3>
                </Link>

<!--                <Link :href="route('information.index')" class="group text-center">-->
<!--                    <i class="fa-circle-info text-xl text-gray-700"-->
<!--                       :class="$page.component.startsWith('Information') ? 'fa-solid text-primary-700' : 'fa-regular' "-->
<!--                    />-->
<!--                    <h3 class="text-sm text-gray-700"-->
<!--                        :class="$page.component.startsWith('Information') ? 'font-semibold text-primary-700' : '' ">-->
<!--                        Informasi-->
<!--                    </h3>-->
<!--                </Link>-->

                <Link :href="route('profile.index')" class="group text-center">
                    <i class="fa-user text-xl text-gray-700"
                       :class="$page.component.startsWith('Profile') ? 'fa-solid text-primary-700' : 'fa-regular' "
                    />
                    <h3 class="text-sm text-gray-700"
                        :class="$page.component.startsWith('Profile') ? 'font-semibold text-primary-700' : '' ">
                        Saya
                    </h3>
                </Link>
            </div>
        </div>
    </div>
</template>
