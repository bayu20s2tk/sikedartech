<script setup>
import {onMounted, ref, watch} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import EditorInput from "@/Components/EditorInput.vue";

const props = defineProps({
    course: Object | String,
    gallery: Object
});

const form = useForm({
    id: props.course.id,
    content: props.course.content ?? '',
});

const updateContent = () => {

    form.put(route('course.update', props.course), {
        errorBag: 'updateInformation',
        preserveScroll: true,
        onSuccess: () => showPage(),
    });
};

const showPage = () => {

};

</script>

<template>
    <FormSection @submitted="updateContent">
        <template #title>
            Konten
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>

            <div class="col-span-6 sm:col-span-6">

                <EditorInput
                    v-model="form.content"
                />

                <InputError :message="form.errors.content" class="mt-2"/>

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
