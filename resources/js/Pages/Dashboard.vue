<template>
    <app-layout>
        <template #header>
            <jet-button v-for="parking in parkingLots" :color="selected?.id === parking.id ? 'blue' : 'white'" class="mx-1 px-4" @click="select(parking)">
                {{ parking.name }}
            </jet-button>
        </template>
        <div v-if="selected?.id">
            <reservations-list :parking="selected"/>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import ReservationsList from '@/Pages/Reservations/List'
import Welcome from '@/Jetstream/Welcome'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        AppLayout,
        Welcome,
        ReservationsList,
        JetButton
    },
    data() {
        return {
            parkingLots: [],
            selected: {}
        }
    },
    methods: {
        refresh() {
            this.loading = true;
            this.list = [];
            axios.get(route('parking.show', {parking: 'all'})).then(response => {
                this.parkingLots = response.data;

                this.selected = this.parkingLots.find( parking => parking.id === 1 );
            });
        },
        select(parking) {
            this.selected = parking;
        }
    },
    mounted() {
        this.refresh();
    }
}
</script>
