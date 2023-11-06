<script setup>
import {onBeforeUnmount, onMounted, onUnmounted, ref} from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from "@/Components/TextAreaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
    category: Object | String,
});

const form = useForm({
    name: props.category.name ?? null,
    desc: props.category.desc ?? null,
    icon: props.category.icon ?? null,
});

const storeInformation = () => {

    if (props.category.name == null) {
        form.post(route('blogCategory.store'), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => showPage(),
        });
    } else {
        form.put(route('blogCategory.update', props.category), {
            errorBag: 'updateInformation',
            preserveScroll: true,
            onSuccess: () => showPage(),
        });
    }
};

const showPage = () => {

};


</script>

<template>
    <FormSection @submitted="storeInformation">
        <template #title>
            Kategori Blog
        </template>

        <template #description>
            Tambahkan informasi kategori blog sesuai kebutuhan aplikasi.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Judul" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                    required
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-5">
                <InputLabel for="desc" value="Deskripsi" />
                <TextAreaInput
                    id="desc"
                    v-model="form.desc"
                    class="mt-1 block w-full"
                    rows="2"
                    required
                />
                <InputError :message="form.errors.desc" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="icon" value="Ikon" />
                <TextInput
                    id="icon"
                    v-model="form.icon"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="icon"
                    required
                />
                <InputError :message="form.errors.icon" class="mt-2" />
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
