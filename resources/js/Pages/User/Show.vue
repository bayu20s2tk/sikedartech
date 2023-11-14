<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from '@/Components/TextInput.vue';
import {ref} from "vue";
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PreviousButton from "@/Components/PreviousButton.vue";
import {Link} from "@inertiajs/vue3";
import moment from "moment/moment";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import {StarIcon} from "@heroicons/vue/20/solid";

const props = defineProps({
    users: Object | String,
});

function formattedDate(value) {
    return moment(value).format('DD MMM Y HH:mm')
}

function formatPrice(value) {
    let val = (value/1).toFixed(0).replace('.', '')
    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

</script>

<template>
    <AppLayout title="Pengguna"
               name="Pengguna"
               desc="lorem ipsum"
    >

        <template #previous>
            <PreviousButton />
        </template>

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl overflow-hidden shadow-lg border border-gray-300">
            <div class="py-4 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <div class="tracking-tight flex gap-5 items-center">
                    <div class="">
                        <img v-if="props.users.profile_photo_url" class="mx-auto h-20 w-20 object-cover rounded-full"
                             :src="props.users.profile_photo_url" :alt="props.users.name" />
                    </div>

                    <div class="">
                        <span class="block text-xl font-bold text-gray-900 sm:text-2xl capitalize">{{ props.users.name }}</span>
                        <span class="block font-medium text-gray-600">
<!--                            Rp {{ formatPrice(props.users.wallet_balance) }}-->
                            {{ props.users.role }}
                        </span>
                    </div>

                </div>
                <div class="mt-5 flex lg:mt-0 lg:flex-shrink-0 gap-x-2">
                    <PrimaryButton v-if="$page.props.user.role_id==1" as="a" :href="route('user.edit', props.users)">
                        Ubah Data
                    </PrimaryButton>

                    <!--                    <SecondaryButton >-->
                    <!--                        <i class="fa-regular fa-coins mr-1"/>-->
                    <!--                        Withdraw-->
                    <!--                    </SecondaryButton>-->
                </div>
            </div>
        </div>

        <div class="mt-10">
            <div class="lg:grid lg:grid-cols-2 mt-10">
                <div class="">
                    <h2 class="text-xl font-bold tracking-tight text-gray-900">Review Worker</h2>
                    <div class="mt-3 flex items-center">
                        <div>
                            <div class="flex items-center">
                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                                          :class="[Number(props.users.review_worker_average) > rating ? 'text-yellow-400' : 'text-gray-300', 'flex-shrink-0 h-5 w-5']"
                                          aria-hidden="true"/>
                            </div>
                        </div>
                        <p class="ml-2 text-sm text-gray-900">Based on {{ props.users.worker.length }} reviews</p>
                    </div>

                    <div class="mt-10">
                        <div class="flow-root">
                            <div class="">
                                <div v-for="review in props.users.worker" :key="review.id"
                                     class="py-5">
                                    <div class="flex items-center">
                                        <img :src="review.user.profile_photo_url" :alt="`${review.user.name}.`"
                                             class="h-12 w-12 rounded-full"/>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-bold text-gray-900">{{ review.user.name }}</h4>
                                            <div class="mt-1 flex items-center">
                                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]"
                                                          :key="rating"
                                                          :class="[review.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']"
                                                          aria-hidden="true"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-6 text-sm text-gray-600"
                                         v-html="review.desc"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <h2 class="text-xl font-bold tracking-tight text-gray-900">Review Owner</h2>
                    <div class="mt-3 flex items-center">
                        <div>
                            <div class="flex items-center">
                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                                          :class="[Number(props.users.review_owner_average) > rating ? 'text-yellow-400' : 'text-gray-300', 'flex-shrink-0 h-5 w-5']"
                                          aria-hidden="true"/>
                            </div>
                        </div>
                        <p class="ml-2 text-sm text-gray-900">Based on {{ props.users.owner.length }} reviews</p>
                    </div>

                    <div class="mt-10">
                        <div class="flow-root">
                            <div class="">
                                <div v-for="review in props.users.owner" :key="review.id"
                                     class="py-5">
                                    <div class="flex items-center">
                                        <img :src="review.user.profile_photo_url" :alt="`${review.user.name}.`"
                                             class="h-12 w-12 rounded-full"/>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-bold text-gray-900">{{ review.user.name }}</h4>
                                            <div class="mt-1 flex items-center">
                                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]"
                                                          :key="rating"
                                                          :class="[review.rating > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']"
                                                          aria-hidden="true"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-6 text-sm text-gray-600"
                                         v-html="review.desc"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="rounded-3xl bg-white bg-opacity-50 backdrop-blur-2xl overflow-hidden shadow-lg border border-gray-300">
            <ul role="list" class="divide-y divide-gray-300 dark:divide-gray-600">
<!--                <template v-for="history in $page.props.history">-->
<!--                    <li>-->
<!--                        <Link preserve-scroll :href="route('history.show', history)" class="block hover:bg-primary-50" >-->
<!--                            <div class="px-4 py-4 sm:px-6">-->
<!--                                <div class="flex items-center justify-between">-->
<!--                                    <p class="font-medium text-primary-600 truncate">{{ history.product_name }}</p>-->
<!--                                    <div class="ml-2 flex-shrink-0 flex">-->
<!--                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full "-->
<!--                                           :class="history.status_id == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"-->
<!--                                        >-->
<!--                                            {{ history.status }}-->
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="mt-2 sm:flex sm:justify-between">-->
<!--                                    <div class="sm:flex">-->
<!--                                        <p class="flex items-center text-sm text-gray-900">-->
<!--                                            &lt;!&ndash;                                                <i class="fa-regular text-gray-500 pr-2" :class="history.category_id == 1 ? 'fa-plus' : 'fa-minus' " />&ndash;&gt;-->
<!--                                            {{ history.category_id == 1 ? '+' : '-' }} Rp {{ formatPrice(history.gross_amount) }}-->
<!--                                        </p>-->
<!--                                        &lt;!&ndash;                                        <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">&ndash;&gt;-->
<!--                                        &lt;!&ndash;&lt;!&ndash;                                                <i class="fa-regular fa-down-to-bracket text-gray-500 pr-2" />&ndash;&gt;&ndash;&gt;-->
<!--                                        &lt;!&ndash;                                            {{ history.order_id }}&ndash;&gt;-->
<!--                                        &lt;!&ndash;                                        </p>&ndash;&gt;-->
<!--                                    </div>-->
<!--                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">-->
<!--                                        <i class="fa-regular fa-calendar text-gray-500 pr-2" />-->
<!--                                        <p>-->
<!--                                            {{ formattedDate(history.created_at) }}-->
<!--                                        </p>-->
<!--                                        <p class="text-gray-900 ml-2">-->
<!--                                            {{ formattedTime(history.created_at) }}-->
<!--                                        </p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </Link>-->
<!--                    </li>-->

<!--                </template>-->
            </ul>
        </div>


    </AppLayout>



</template>
