<script setup>
import {onMounted, ref, watch} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import EditorInput from "@/Components/EditorInput.vue";
import TextInput from "../../../Components/TextInput.vue";
import DangerButton from "../../../Components/DangerButton.vue";

const props = defineProps({
    course: Object | String,
});

const form = useForm({
    id: null,
    course_id: props.course.id,
    name: null,
    content: null,
});

const updateContent = () => {
    if (form.id == null) {
        form.post(route('courseItem.store'), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => {
                form.reset()
            },
        });
    } else {
        form.put(route('courseItem.update', form), {
            errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => {

            },
        });
    }
};

const deleteContent = (item) => {
    form.delete(route('courseItem.destroy', item), {
        // errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {
            courseTab.value=false
            form.reset()
        },
    });
};

const create = () => {
    form.reset()
    form.id = null
    form.name = null
    form.content = null
    courseTab.value = false
}
const edit = (item) => {
    form.reset()
    form.id = item.id
    form.name = item.name
    form.content = item.content
};

const courseTab = ref(false)

</script>

<template>
    <FormSection @submitted="updateContent">
        <template #title>
            Konten
        </template>

        <template #description>
            Tambahkan informasi konten sesuai kebutuhan aplikasi.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 flex flex-wrap gap-3">
                <template v-for="(list, listIdx) in course.item" :key="list.id">
                    <button
                        type="button"
                        class="rounded-3xl py-3 px-5 text-left"
                        :class="courseTab==list.id ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                        @click="courseTab=list.id; edit(list)"
                    >
                        {{ listIdx+1 }}. {{ list.name }}
                    </button>
                </template>
                <button type="button" @click="create">
                    <div
                        class="rounded-full py-3 px-5 bg-gray-200"
                        :class="courseTab==false ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-900' "
                    >
                        <i class="fa-solid fa-plus" />
                        <span v-if="courseTab==false" class="ml-2">Lesson Baru</span>
                    </div>
                </button>
            </div>

            <div class="col-span-6 sm:col-span-6 ">
                <div class="pt-5 border-t border-gray-300">
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
            </div>
        </template>

        <template #actions>
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start">
                    <DangerButton
                        v-if="courseTab!=false"
                        @click="deleteContent(courseTab)"
                        type="button"
                        class="group"
                    >
                        <i class="fa-duotone fa-trash" />
                        <span class="ml-2 hidden group-hover:block">Hapus</span>
                    </DangerButton>
                </div>
                <div class="flex items-center justify-end">
                    <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                        Berhasil disimpan.
                    </ActionMessage>

                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Simpan
                    </PrimaryButton>
                </div>
            </div>

        </template>
    </FormSection>
</template>
