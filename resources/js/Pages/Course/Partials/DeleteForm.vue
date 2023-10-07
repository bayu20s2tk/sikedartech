<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    course: Object
})

const passwordInput = ref(null);

const form = useForm({
    id: props.course.id,
});

const deletePage = () => {
    form.delete(route('course.destroy', props.course), {
        preserveScroll: true,
        // onSuccess: () => closeModal(),
        // onError: () => passwordInput.value.focus(),
        // onFinish: () => form.reset(),
    });
};

</script>

<template>
    <ActionSection>
        <template #title>
            Hapus Halaman
        </template>

        <template #description>
            Hapus halaman secara permanen
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Setelah halaman dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
            </div>

            <div class="mt-5">
                <DangerButton class="" @click="deletePage">
                    Hapus halaman
                </DangerButton>
            </div>

        </template>
    </ActionSection>
</template>
