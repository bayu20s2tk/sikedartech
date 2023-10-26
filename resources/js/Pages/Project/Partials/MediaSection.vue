<script setup>
import {computed, ref} from 'vue';
import {Link, useForm, usePage, router} from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
    project: Object,
});

const form = useForm({
    id: props.project.id,
    media: null,
});

const mediaPreview = ref(null);
const mediaInput = ref(null);

const storePageMedia = () => {
    if (mediaInput.value) {
        form.media = mediaInput.value.files[0];
    }

    form.post(route('project.addMedia'), {
        errorBag: 'storeMedia',
        preserveScroll: true,
        onSuccess: () => {
            mediaPreview.value = null;
            clearMediaFileInput();
            form.reset();
        },
    });
};

const selectNewMedia = () => {
    mediaInput.value.click();
};

const updateMediaPreview = () => {
    const media = mediaInput.value.files[0];

    if (!media) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        mediaPreview.value = e.target.result;
    };

    reader.readAsDataURL(media);

    storePageMedia()
};

const deleteMedia = (project, index) => {
    router.delete(route('project.deleteMedia', index), {
        preserveScroll: true,
        onSuccess: () => {
            mediaPreview.value = null;
            clearMediaFileInput();
        },
    });
};

const clearMediaFileInput = () => {
    if (mediaInput.value?.value) {
        mediaInput.value.value = null;
    }
};

</script>

<template>

    <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-5">
        <template v-for="(media, index) in props.project.media">
            <div class="relative py-3 px-2 flex flex-col items-center justify-center border border-gray-300 rounded-3xl shadow-xl">
                <i class="fa-duotone fa-file text-gray-400 text-5xl"></i>
                <div class="text-center mt-2">
                    <p class="block text-sm font-medium text-gray-900">{{ media.file_name }}</p>
                    <a
                        type="button"
                        :href="media.original_url"
                        :download="media.file_name"
                        class="text-primary-600 text-xs font-semibold"
                    >
                        Download
                    </a>
                    <button class="text-red-600 text-xs font-semibold" @click.prevent="deleteMedia(props.project.id, media.id)">
                        Delete
                    </button>
                </div>
            </div>
        </template>

        <!-- Profile media -->
        <div class="">
            <!-- Profile media File Input -->
            <input
                ref="mediaInput"
                type="file"
                class="hidden"
                @change="updateMediaPreview"
            >

            <div class="block h-full">
                <button @click.prevent="selectNewMedia" type="button"
                        class="relative py-3 px-2 flex flex-col justify-center items-center w-full h-full text-center border-2 border-gray-400 border-dashed focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-2xl shadow-sm">
                    <i class="fa-duotone fa-file text-gray-400 text-5xl"></i>
                    <span class="mt-2 block text-sm font-medium text-gray-900">Tambah Media</span>
                    <p class="text-gray-500 text-xs font-semibold" >
                        * any extension
                    </p>
                </button>
            </div>

            <InputError :message="form.errors.media" class="mt-2"/>
        </div>


<!--        <ActionMessage :on="form.recentlySuccessful" class="mr-3">-->
<!--            Berhasil disimpan.-->
<!--        </ActionMessage>-->

<!--        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">-->
<!--            Simpan-->
<!--        </PrimaryButton>-->
    </div>

</template>
