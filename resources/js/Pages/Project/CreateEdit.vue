<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';

import UpdateInformationForm from "./Partials/UpdateInformationForm.vue";
import DeleteForm from "./Partials/DeleteForm.vue";
import UpdateContentForm from "./Partials/UpdateContentForm.vue";
import PreviousButton from "@/Components/PreviousButton.vue";
import UpdateHeroForm from "./Partials/UpdateHeroForm.vue";
import UpdateAboutForm from "./Partials/UpdateAboutForm.vue";

</script>

<template>
    <AppLayout title="Proyek"
               name="Proyek"
               desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton />
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10">
                <div >
                    <UpdateInformationForm :project="$page.props.project ?? '' " />

                    <SectionBorder />
                </div>

                <template v-if="$page.props.project">
<!--                    <UpdateHeroForm :project="$page.props.project" />-->

<!--                    <SectionBorder />-->

<!--                    <UpdateContentForm :course="$page.props.course" />-->

<!--                    <SectionBorder />-->

<!--                    <UpdateAboutForm :course="$page.props.course" />-->

<!--                    <SectionBorder />-->

                    <DeleteForm :project="$page.props.project" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
