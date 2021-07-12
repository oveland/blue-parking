<template>
    <tr @mouseenter="showActions = true" @mouseleave="showActions = false">
        <td class="px-6 py-2 w-1/4">
            <div class="text-sm font-medium text-gray-900">
                {{ reservation.start }}
            </div>
        </td>

        <td class="px-6 py-2 w-1/4 text-center">
            <div class="text-sm font-medium text-gray-900">
                {{ reservation.vehicle.plate }}
            </div>
        </td>

        <td class="px-6 py-2 w-1/4">
            <div class="text-sm font-medium text-gray-900">
                <span v-if="reservation.active || true" class="text-blue-800 text-uppercase text-xs font-bold">
                    {{ $t(reservation.status).toUpperCase() }}
                </span>
            </div>
        </td>

        <td class="px-6 py-2 w-auto float-right">
            <jet-tooltip class="flex gap-1">
                <reservation-destroy v-if="!disable" :reservation="reservation" class="font-bold hover:opacity-100 opacity-25"></reservation-destroy>

                <jet-button v-if="true" v-show="!disable" @click.native="edit" color="transparent" class="font-bold hover:opacity-100 opacity-25">
                    {{ $t('Edit') }}
                </jet-button>

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
