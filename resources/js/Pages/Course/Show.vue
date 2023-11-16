<script setup>
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import moment from "moment";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Heading from "@/Components/Heading.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PreviousButton from "../../Components/PreviousButton.vue";
import MemberList from "./Partials/MemberList.vue";
import TextInput from "../../Components/TextInput.vue";
import InputLabel from "../../Components/InputLabel.vue";
import InputError from "../../Components/InputError.vue";
import EditorInput from "../../Components/EditorInput.vue";
import ActionMessage from "../../Components/ActionMessage.vue";
import DangerButton from "../../Components/DangerButton.vue";
import LessonForm from "./Partials/LessonForm.vue";
import AssigmentForm from "./Partials/AssigmentForm.vue";
import SummarySection from "../Course/Partials/SummarySection.vue";
import FinanceSection from "./Partials/FinanceSection.vue";

const props = defineProps({
    course: Object,
    subscriber: Object
});

const tab = ref(null)
const tabCourseShow = ref(1)
const tabLesson = ref(0)
const tabAssigment = ref(0)

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

const stats = [
    {name: 'Status', stat: props.course.status, previousStat: ''},
    {name: 'Peserta', stat: props.course.member.length, previousStat: ''},
    {name: 'Owner', stat: props.course.user.name, previousStat: ''},
]

const form = useForm({
    id: null,
    type_id: null,
    course_id: props.course.id,
    name: null,
    content: null,
    link: null,
    media: null,
});

const storeLesson = () => {
    form.type_id = 1
    form.post(route('courseItem.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            form.id = null
            form.name = null
            form.content = null
            tabLesson.value = null
        },
    });
};

const storeAssigment = () => {
    form.type_id = 2
    form.post(route('courseItem.store'), {
        errorBag: 'storeInformation',
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            form.id = null
            form.name = null
            form.content = null
            tabLesson.value = null
        },
    });
};

const create = () => {
    form.reset()
    form.id = null
    form.name = null
    form.content = null
    tabLesson.value = 99
}

const createAssigment = () => {
    form.reset()
    form.id = null
    form.name = null
    form.content = null
    tabAssigment.value = 99
}

// const edit = (item) => {
//     form.reset()
//     form.id = item.id
//     form.name = item.name
//     form.content = item.content
// };
</script>

<template>
    <AppLayout
        title="Kelas"
        name="Kelas"
        desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton/>
        </template>

        <div class="max-w-7xl mx-auto items-start">
            <div class="flex justify-between gap-3">
                <div class="">
                    <h1 class="text-xl font-medium leading-6 text-gray-900">{{ props.course.name }}</h1>
                </div>

                <div class="">
                    <a
                        class="text-primary-600 font-semibold mr-5"
                        target="_blank"
                        :href="route('landing.course.show', props.course)"
                    >
                        <i class="fa-duotone fa-arrow-up-right-from-square mr-1"></i>
                        Lihat
                    </a>
                    <PrimaryButton as="a" :href="route('course.edit', props.course)">Ubah Data</PrimaryButton>
                </div>
            </div>

            <div>
                <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-300 dark:divide-gray-600 border border-gray-300 overflow-hidden rounded-3xl bg-white bg-opacity-50 shadow-lg md:grid-cols-3 md:divide-y-0 md:divide-x">
                    <div v-for="item in stats" :key="item.name" class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
                        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                            <div class="flex items-baseline text-2xl font-semibold text-primary-600">
                                {{ item.stat }}
                                <span class="ml-2 text-sm font-medium text-gray-500">{{ item.previousStat }}</span>
                            </div>
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="my-10">
                <div class="sticky top-0 z-40 backdrop-blur border-b border-gray-200 mb-10">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabCourseShow==1 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                                @click="tabCourseShow=1"
                        >
                            Ringkasan
                        </button>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabCourseShow==2 ? 'border-primary-600 text-primary-600' : 'text-gray-500 border-gray-300' "
                                @click="tabCourseShow=2"
                        >
                            Peserta
                        </button>
                        <template v-if="$page.props.user.role_id==1">
                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabCourseShow==3 ? 'border-cyan-600 text-cyan-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabCourseShow=3"
                                
                        >
                        
                            Lesson-
                        </button>
                        </template>

                        <button class=" w-1/2 py-4 px-1 text-center border-b-2 font-medium text-sm"
                                :class="tabCourseShow==4 ? 'border-cyan-600 text-cyan-600' : 'text-gray-500 border-gray-300 ' "
                                @click="tabCourseShow=4"
                        >
                            Tugas
                        </button>
                    </nav>
                </div>
            </div>

            <template v-if="tabCourseShow==1">
                <SummarySection
                    :course="props.course"
                />
                <FinanceSection
                    :course="props.course"
                    :subscriber="props.subscriber"
                />
            </template>


            <template v-if="tabCourseShow==2">
                <div
                    class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl border border-gray-300 overflow-hidden shadow-lg">
                    <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
                        <template v-for="sub in props.course.member">
                            <MemberList :member="sub" :course_id="props.course.id" />
                        </template>
                    </ul>
                </div>
            </template>

            <template v-else-if="tabCourseShow==3">
                <div class="relative mx-auto grid lg:grid-cols-6 gap-10">
                    <!-- Content area -->
                    <div class="lg:col-span-2 ">
                        <div class="mt-3 bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                            <div class="px-3 py-5 grid gap-3 ">
                                <h3 class="font-semibold text-gray-900 ml-2">
                                    {{ props.course.item.length ?? '0' }} Lesson
                                </h3>

                                <template v-for="(list, listIdx) in props.course.item" :key="list.id">
                                    <button @click="tabLesson=listIdx">
                                        <div
                                            class="rounded-3xl py-3 px-5 text-left "
                                            :class="tabLesson==listIdx ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                        >
                                            <!--                                                <i class="fa-solid fa-play mr-1"/>-->
                                            {{ listIdx + 1 }}. {{ list.name }}
                                        </div>
                                    </button>
                                </template>

                                <button type="button" @click="create">
                                    <div
                                        class="rounded-3xl py-3 px-5 text-left"
                                        :class="tabLesson==99 ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                    >
                                        <i class="fa-solid fa-plus"/>
                                        <span class="ml-2">Lesson Baru</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 py-3">
                        <template v-for="(item, itemIdx) in props.course.item">
                            <template v-if="tabLesson==itemIdx">
                                <LessonForm :item="item" :course_id="props.course.id"/>
                            </template>
                        </template>

                        <div v-if="tabLesson==99"
                             class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg p-5">
                            <div class=" ">
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

                            <div class="">
                                <InputLabel class="mb-1 mt-5" value="Konten"/>

                                <EditorInput
                                    v-model="form.content"
                                />
                                <InputError :message="form.errors.content" class="mt-2"/>
                            </div>

                            <div class="grid grid-cols-2 pt-5 mt-5 border-t border-gray-300">
                                <div class="flex justify-start">

                                </div>
                                <div class="flex items-center justify-end">
                                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                                        Berhasil disimpan.
                                    </ActionMessage>

                                    <PrimaryButton
                                        @click.prevent="storeLesson"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Simpan
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

            <template v-else-if="tabCourseShow==4">
                <div class="relative mx-auto grid lg:grid-cols-6 gap-10">
                    <!-- Content area -->
                    <div class="lg:col-span-2 ">
                        <div class="mt-3 bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg">
                            <div class="px-3 py-5 grid gap-3 ">
                                <h3 class="font-semibold text-gray-900 ml-2">
                                    {{ props.course.assigment.length ?? '0' }} Tugas
                                </h3>

                                <template v-for="(list, listIdx) in props.course.assigment" :key="list.id">
                                    <button @click="tabAssigment=listIdx">
                                        <div
                                            class="rounded-3xl py-3 px-5 text-left "
                                            :class="tabAssigment==listIdx ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                        >
                                            <!--                                                <i class="fa-solid fa-play mr-1"/>-->
                                            {{ listIdx + 1 }}. {{ list.name }}
                                        </div>
                                    </button>
                                </template>

                                <button type="button" @click="createAssigment">
                                    <div
                                        class="rounded-3xl py-3 px-5 text-left"
                                        :class="tabAssigment==99 ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                                    >
                                        <i class="fa-solid fa-plus"/>
                                        <span class="ml-2">Tugas Baru</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4 py-3">
                        <template v-for="(item, itemIdx) in props.course.assigment">
                            <template v-if="tabAssigment==itemIdx">
                                <AssigmentForm :item="item" :course_id="props.course.id"/>
                            </template>
                        </template>

                        <div v-if="tabAssigment==99"
                             class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg p-5">
                            <div class=" ">
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

                            <div class="">
                                <InputLabel class="mb-1 mt-5" value="Deskripsi"/>

                                <EditorInput
                                    v-model="form.content"
                                />
                                <InputError :message="form.errors.content" class="mt-2"/>
                            </div>

                            <div class=" ">
                                <InputLabel class="mb-1 mt-5" value="Link"/>
                                <TextInput
                                    v-model="form.link"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="http://"
                                />
                                <InputError :message="form.errors.link" class="mt-2"/>
                            </div>

                            <div class="">
                                <InputLabel class="mb-1 mt-5" value="Attachment"/>

                                <p class="text-gray-500 text-sm">*simpan tugas terlebih dahulu untuk membuat
                                    attachment</p>
                            </div>

                            <div class="grid grid-cols-2 pt-5 mt-5 border-t border-gray-300">
                                <div class="flex justify-start">

                                </div>
                                <div class="flex items-center justify-end">
                                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                                        Berhasil disimpan.
                                    </ActionMessage>

                                    <PrimaryButton
                                        @click.prevent="storeAssigment"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing">
                                        Simpan
                                    </PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </template>

        </div>


    </AppLayout>

</template>
