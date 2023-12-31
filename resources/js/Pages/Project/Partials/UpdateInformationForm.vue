<script setup>
import {onBeforeUnmount, onMounted, onUnmounted, ref} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from "@/Components/TextAreaInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import EditorInput from "../../../Components/EditorInput.vue";

const props = defineProps({
    project: Object | String,
    gallery: Object
});

const form = useForm({
    name: props.project.name ?? null,
    desc: props.project.desc ?? null,
    budget_from: props.project.budget_from ?? null,
    budget_to: props.project.budget_to ?? null,
    category_id: props.project.category_id ?? null,
    finish_day: props.project.finish_day ?? null
});

const storeInformation = () => {

    if (props.project.name == null) {
        form.post(route('project.store'), {
            errorBag: 'storeInformation',
            preserveScroll: true,
            onSuccess: () => showPage(),
        });
    } else {
        form.put(route('project.update', props.project), {
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
            Informasi Proyek
        </template>

        <template #description>
            Tambahkan informasi proyek sesuai kebutuhan pekerjaan.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
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

            <div class="col-span-6">
                <InputLabel for="desc" value="Deskripsi"/>
                <EditorInput
                    v-model="form.desc"
                    :gallery="props.gallery"
                />
<!--                <TextAreaInput-->
<!--                    id="desc"-->
<!--                    v-model="form.desc"-->
<!--                    class="mt-1 block w-full"-->
<!--                    rows="2"-->
<!--                    required-->
<!--                />-->
                <InputError :message="form.errors.desc" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="price" value="Rentang Budget"/>
                <div class="flex">
                    <div class="flex">
                        <span class="flex items-center bg-white text-black border border-gray-300 border-r-0 rounded-3xl rounded-r-none shadow-sm mt-1 px-3 ">Rp</span>
                        <TextInput
                            id="price"
                            v-model="form.budget_from"
                            type="number"
                            class="mt-1 block w-full rounded-l-none rounded-r-none"
                        />
                        <InputError :message="form.errors.budget_from" class="mt-2"/>
                    </div>

                    <div class="flex">
                        <span class="flex items-center bg-white text-black border border-gray-300 border-r-0 border-l-0 rounded-3xl rounded-r-none rounded-l-none shadow-sm mt-1 px-3 "> - </span>
                        <TextInput
                            id="price"
                            v-model="form.budget_to"
                            type="number"
                            :min="form.budget_from"
                            class="mt-1 block w-full rounded-l-none"
                        />
                        <InputError :message="form.errors.budget_to" class="mt-2"/>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="category" value="Kategori"/>
                <SelectInput
                    id="category"
                    v-model:model-value.number="form.category_id"
                    :option="$page.props.selectCategory"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="form.errors.category_id" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-2">
                <InputLabel for="deadline" value="Deadline"/>
                <SelectInput
                    id="deadline"
                    v-model:model-value.number="form.finish_day"
                    :option="$page.props.selectDay"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="form.errors.finish_day" class="mt-2"/>
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
