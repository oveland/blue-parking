<template>
    <tr @mouseenter="showActions = true" @mouseleave="showActions = false">
        <td class="pl-6 py-2 w-1/12 text-center">
            <div class="text-sm font-bold text-gray-500">
                <small>{{ reservation.id }}</small>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="flex gap-2 items-center">
                <div>
                    <icon :name="reservation.vehicle.type.icon" :color="reservation.vehicle.type.color" density="700" w="8" h="8"></icon>
                </div>
                <div class="text-sm text-gray-500">
                    <span class="font-extrabold">{{ reservation.vehicle.plate }}</span>
                    <div v-if="reservation.vehicle.model">
                        <small>{{ reservation.vehicle.model }}</small> • <small>{{ reservation.vehicle.color }}</small>
                    </div>
                </div>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="text-sm text-gray-500 font-semibold">
                {{ reservation.vehicle.user?.name }}
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="text-sm text-gray-500 font-semibold">
                <jet-tooltip placement="left">
                    <div class="flex items-center gap-1">
                        <icon name="arrow-circle-left" color="blue" :density="200" size="4" class="opacity-70"></icon>
                        <span>{{ startTimeString }}</span>
                    </div>
                    <template #data>
                        <small>{{ $t('Entry') }} {{ startDateString }}</small>
                    </template>
                </jet-tooltip>

                <jet-tooltip v-if="reservationIsFinalized" placement="left">
                    <div class="flex items-center gap-1">
                        <icon name="arrow-circle-right" color="green" :density="500" size="4" class="opacity-70"></icon>
                        <span>{{ endTimeString }}</span>
                    </div>
                    <template #data>
                        <small>{{ $t('Exit') }} {{ endDateString }}</small>
                    </template>
                </jet-tooltip>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div v-if="reservation.active || true" class="text-sm text-gray-500">
                <span  class="text-uppercase text-xs font-bold" :class="`text-${reservation.status.color}-500`">
                    {{ $t(reservation.status.name).toUpperCase() }}
                </span>
                <div>
                    <time-ago :from="reservation.start" :to="reservation.end" @elapsed="elapsed"></time-ago>
                </div>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4 text-sm text-gray-500 font-semibold">
            <div>
                {{ reservation.zone.code }}
            </div>
            <div class="text-gray-400">
                <small>${{ reservation.type.tariff }}/min</small>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4 text-sm text-gray-500 font-semibold">
            <div>
                {{ $filter.currency(charges) }}
            </div>
            <div class="text-gray-400">
                <small>{{ elapsedTime }} min</small>
            </div>
        </td>

        <td class="px-6 py-2 w-auto float-right">
            <jet-tooltip class="flex items-center gap-1 align-middle md:mt-2">
                <reservation-destroy class="font-bold hover:opacity-100 opacity-40"
                    v-if="!disable"
                    :reservation="reservation"
                     @refresh="$emit('refresh')"
                ></reservation-destroy>

                <icon v-show="!disable && reservationIsOpen" @click="edit" color="yellow" class="hover:opacity-100 opacity-50" name="edit" size="4"></icon>
                <icon v-show="!disable && reservationIsOpen" @click="finalize" color="lime" class="hover:opacity-100 opacity-50" name="exit" size="4"></icon>

                <template #data>
                    {{ $t('Updated') }}: {{ reservation.updatedAt }}
                </template>
            </jet-tooltip>
        </td>
    </tr>
</template>

<script>
import Icon from '@/Jetstream/Icon'
import JetButton from '@/Jetstream/Button'
import JetCheck from '@/Jetstream/Check'
import JetLabel from '@/Jetstream/Label'
import JetTooltip from '@/Jetstream/Tooltip'
import ReservationDestroy from '@/Pages/Reservations/Destroy'

import TimeAgo from '@/Jetstream/TimeAgo'

import moment from 'moment'

export default {
    props: {
        reservation: {
            type: Object,
            required: true
        },
        disable: Boolean,
    },
    data() {
        return {
            showActions: false,
            elapsedTime: 0
        }
    },
    components: {
        Icon,
        ReservationDestroy,
        JetButton,
        JetCheck,
        JetLabel,
        JetTooltip,
        TimeAgo
    },
    computed: {
        start() {
            return moment(this.reservation.start)
        },
        end() {
            return moment(this.reservation.end)
        },
        startTimeString() {
            return this.start.format('HH:mm:ss')
        },
        startDateString() {
            return this.start.format('yyyy-MM-DD')
        },
        endTimeString() {
            return this.reservation.end ? this.end.format('HH:mm:ss') : '';
        },
        endDateString() {
            return this.reservation.end ? this.end.format('yyyy-MM-DD') : '';
        },
        reservationIsOpen() {
            return this.reservation.active;
        },
        reservationIsFinalized() {
            return !this.reservationIsOpen;
        },
        charges() {
            return this.elapsedTime * this.reservation.type.tariff;
        }
    },
    methods: {
        elapsed(value) {
            this.elapsedTime = parseInt(value);
        },
        edit() {
            this.reservation.edit = true;
            this.$emit('edit', this.reservation);
        },
        finalize() {
            this.reservation.finalize = true;
            this.$emit('finalize', this.reservation);
        }
    }
}
</script>

<style scoped>

</style>
