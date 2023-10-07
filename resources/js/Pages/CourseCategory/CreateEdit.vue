<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';

import UpdateInformationForm from "./Partials/UpdateInformationForm.vue";
import DeleteForm from "./Partials/DeleteForm.vue";
import PreviousButton from "@/Components/PreviousButton.vue";

</script>

<template>
    <AppLayout title="Kategori Blog"
               name="Kategori Blog"
               desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton />
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10">
                <div >
                    <UpdateInformationForm :category="$page.props.category ?? '' " />

                    <SectionBorder />
                </div>

                <template v-if="$page.props.category">
                    <DeleteForm :category="$page.props.category" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
