<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                {{ $t('Dashboard') }}
            </h2>
        </template>
        <div>
            <reservations-list/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ReservationsList from '@/Pages/Reservations/List'
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
        AppLayout,
        Welcome,
        ReservationsList,
    },
}
</script>
