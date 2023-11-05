<script setup>
import InputError from "../../../Components/InputError.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import TextInput from "../../../Components/TextInput.vue";
import EditorInput from "../../../Components/EditorInput.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import DangerButton from "../../../Components/DangerButton.vue";
import ActionMessage from "../../../Components/ActionMessage.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";

const props = defineProps({
    item: Object,
    course_id: Number
});

const form = useForm({
    id: props.item.id,
    course_id: props.course_id,
    type_id: 1,
    name: props.item.name,
    content: props.item.content,
});
const updateContent = () => {
    form.put(route('courseItem.update', form), {
        errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {

        },
    });
};

const deleteContent = () => {
    form.delete(route('courseItem.destroy', props.item), {
        // errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {
            // form.reset()
        },
    });
};

const edit = (item) => {
    form.reset()
    form.id = item.id
    form.name = item.name
    form.content = item.content
};

</script>

<template>
    <div class="bg-white bg-opacity-50 border border-gray-300 rounded-3xl shadow-lg p-5">
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
                <DangerButton
                    @click="deleteContent"
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

                <PrimaryButton
                    @click.prevent="updateContent"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    Simpan
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
