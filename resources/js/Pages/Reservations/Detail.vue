<template>
    <tr @mouseenter="showActions = true" @mouseleave="showActions = false">
        <td class="px-6 py-2 w-1/4">
            <div class="text-sm font-medium text-gray-900">
                {{ reservation.vehicle.plate }}
                <br>
                <small class="text-xs">{{ reservation.vehicle.type.name }} • {{ reservation.vehicle.color }}</small>
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="text-sm font-medium text-gray-900">
                {{ reservation.vehicle.user?.name }}
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="text-sm font-medium text-gray-900">
                {{ reservation.startHuman }}
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div v-if="reservation.active || true" class="text-sm font-medium text-gray-900">
                <span  class="text-uppercase text-xs font-bold" :class="`text-${reservation.status.color}-600`">
                    {{ $t(reservation.status.name).toUpperCase() }}
                </span>
                <br>
                <small class="text-xs">
                    <time-ago :from="reservation.start" :to="reservation.end"></time-ago>
                </small>
            </div>
        </td>

        <td class="px-6 py-2 w-auto float-right">
            <jet-tooltip class="flex gap-1">
                <reservation-destroy class="font-bold hover:opacity-100 opacity-25"
                    v-if="!disable"
                    :reservation="reservation"
                     @refresh="$emit('refresh')"
                ></reservation-destroy>

                <icon v-show="!disable" @click="edit" color="yellow" class="hover:opacity-100 opacity-25" name="edit"></icon>
                <icon v-show="!disable" @click="edit" color="green" class="hover:opacity-100 opacity-25" name="exit"></icon>

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
            showActions: false
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
    methods: {
        edit() {
            this.reservation.edit = true;
            this.$emit('edit');
        }
    }
}
</script>

<style scoped>

</style>
