<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $t('Reservations') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <reservation-list></reservation-list>
            </div>
        </div>
    </app-layout>
</template>

<script>

import JetBanner from "@/Jetstream/Banner";
import AppLayout from "@/Layouts/AppLayout";
import ReservationList from "@/Pages/Reservations/List";

export default {
    props: {
        reservations: Array
    },
    components: {
        JetBanner,
        ReservationList,
        AppLayout
    }
}
</script>

<style scoped>

</style>
