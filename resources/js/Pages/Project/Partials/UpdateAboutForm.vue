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
    id: props.course.id,
    about: props.course.about ?? null,
});

const updateAbout = () => {
    form.put(route('course.update', props.course), {
        errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => {

        },
    });
};

</script>

<template>
    <FormSection @submitted="updateAbout">
        <template #title>
            Tentang
        </template>

        <template #description>
            Tambahkan informasi tentang sesuai kebutuhan aplikasi.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-6 ">
                <EditorInput
                    v-model="form.about"
                />
                <InputError :message="form.errors.about" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Berhasil disimpan.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Simpan
            </PrimaryButton>
        </template>
    </FormSection>
</template>
