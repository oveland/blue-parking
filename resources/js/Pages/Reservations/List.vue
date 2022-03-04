<template>
    <div class="">
        <div class="bg-white grid">
            <div class="px-6 py-5">
                <div class="flex flex-row items-center">
                    <div class="w-1/4 md:w-1/4">
                        <div class="text-lg cursor-pointer flex items-center" @click="refresh">
                            <div class="float-left animate-pulse mr-2">
                                <icon name="loading" v-if="loading"></icon>
                                <icon name="reservation" v-if="!loading"></icon>
                            </div>
                            <div class="font-bold">
                                {{ list.length }} <span class="hidden sm:inline-block">{{ $t('Reservations') }}</span>
                            </div>
                        </div>
                        <div v-if="parking.id === 'any'">
                            {{ $t('All') }}
                        </div>
                        <div v-else>
                            <span class="hidden text-gray-400 font-bold sm:inline-block md:text-gray-700">{{ parking.address }}</span>
                            <span class="hidden text-gray-400 font-extrabold md:inline-block pl-1">• <small>{{ parking.description }}</small></span>
                        </div>
                    </div>

                    <div class="w-1/4 md:w-1/2 px-1 flex items-center justify-center">
                        <jet-button :disabled="disable" @click="add()" class="hidden md:block">
                            {{ $t('Create') }}
                        </jet-button>
                        <span>
                            <icon name="add" size="8" color="indigo" @click="add()" class="float-right md:hidden"></icon>
                        </span>
                    </div>

                    <div class="w-1/2 md:w-1/4 text-right md:text-center">
                        <jet-select-date v-model="date"></jet-select-date>
                    </div>
                </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 hidden">
                    {{ $t('Description') }}
                </p>
            </div>

            <div class="border-b border-b-indigo-900 border-t borde-t-gray-200 overflow-x-scroll">
                <div class="px-6 flex gap-2 zone-list">
                    <jet-button v-for="zone in zones" @click="selectZone(zone)" color="white" :class="{selected: selectedZone?.id === zone.id }">
                        <div class="float-left">{{ zone.code }}</div>
                    </jet-button>
                </div>
            </div>

            <div class="border-t border-gray-200 overflow-x-scroll">
                <jet-table v-if="list.length">
                    <template #head>
                        <tr>
                            <th scope="col" class="pl-6 py-3 text-center text-sm text-gray-400 uppercase">
                                {{ $t('#') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Vehicle') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase hidden">
                                {{ $t('Client') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Time') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Zone') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Time parking') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-sm  text-gray-400 uppercase">
                                <span class="">{{ $t('Actions') }}</span>
                            </th>
                        </tr>
                    </template>
                    <template #body>
                        <template v-for="(reservation, index) in sortedList">
                            <reservation-detail :reservation.sync="reservation"
                                                :disable="disable"
                                                :class="{ 'bg-gray-50': index % 2 !== 0 }"
                                                @edit="setModal"
                                                @finalize="setModal"
                                                @refresh="refresh"
                            ></reservation-detail>
                        </template>
                    </template>
                </jet-table>

                <div v-if="!list.length && !loading"
                     class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        <jet-action-message :on="true">{{ $t('No registers') }}</jet-action-message>
                    </dt>
                </div>
            </div>
        </div>

        <jet-dialog-modal :show="showModalForm" @close="closeModal" width="md" :no-footer="true">
            <template #title>
                <div class="flex gap-2 items-center font-extrabold text-gray-500">
                    <icon name="reservation"></icon>
                    <div>
                        <span v-if="dataForm.finalize">{{ $t('Finalize') }}</span>
                        <span v-else-if="dataForm.create">{{ $t('Create') }}</span>
                        <span v-if="dataForm.edit">{{ $t('Edit') }}</span>
                        <span class="ml-1">{{ $t('Reservation') }}</span>
                    </div>
                </div>
            </template>
            <template #content>
                <reservation-form :reservation.sync="dataForm" :parking="parking" @refresh="refresh" @close="dataForm = null"></reservation-form>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
import Icon from '@/Jetstream/Icon'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetInput from '@/Jetstream/Input'
import JetLink from '@/Jetstream/NavLink'
import JetLabel from '@/Jetstream/Label'
import JetCheck from '@/Jetstream/Check'
import ReservationForm from '@/Pages/Reservations/Form'
import ReservationDetail from '@/Pages/Reservations/Detail'
import JetTable from '@/Jetstream/Table'
import JetSelectDate from '@/Jetstream/SelectDate'

import moment from 'moment'
import Button from "@/Jetstream/Button";

export default {
    props: ['parking'],
    created() {
        this.refresh();
    },
    data() {
        return {
            list: [],
            loading: false,
            date: moment().format('YYYY-MM-DD'),
            zones: [],
            selectedZone: {},
            dataForm: {
                create: false,
                edit: false,
            }
        }
    },
    components: {
        Button,
        JetTable,
        JetLabel,
        JetCheck,
        JetLink,
        JetButton,
        Icon,
        JetSecondaryButton,
        JetDangerButton,
        JetInput,
        JetDialogModal,
        JetActionMessage,
        ReservationForm,
        ReservationDetail,
        JetSelectDate
    },
    computed: {
        showModalForm() {
            return this.dataForm && (this.dataForm.create || this.dataForm.edit || this.dataForm.finalize);
        },
        disable() {
            return this.showModalForm || this.loading;
        },
        sortedList() {
            return _.sortBy(this.list, 'start');
        }
    },
    watch: {
        parking() {
            console.log('LOAD by parking! ', this.zones);
            this.refreshAll();
        },
        date() {
            console.log('LOAD by date! ', this.zones);
            if (!this.zones.length) this.refreshAll();
            else this.refresh();
        }
    },
    methods: {
        refreshAll() {
            this.loadZones().then(() => {
                this.refresh();
            });
        },
        loadZones() {
            this.loading = true;
            return new Promise((resolve) => {
                axios.get(route('parking.zones', {parking: this.parking?.id})).then(response => {
                    this.zones = response.data;

                    this.selectedZone = this.zones.find( zone => zone.id === 'any' );
                    this.reset();

                    return resolve(true);
                });
            });
        },
        refresh() {
            this.loading = true;
            this.list = [];
            axios.get(route('reservations.show', {reservation: this.parking?.id ? this.parking?.id : 'all'}), {
                params: {
                    date: moment(this.date).format('YYYY-MM-DD'),
                    zone: this.selectedZone?.id
                }
            }).then(response => {
                this.list = response.data
                this.reset();
            });
        },
        add() {
            this.dataForm = {
                id: Date.now(),
                start: '',
                active: true,
                vehicle: {
                    plate: '',
                    color: '',
                    model: '',
                    user: {
                        name: '',
                    },
                },
                type: {
                    id: null,
                    zones: []
                },
                zone: null,
                updatedAt: '',
                create: true,
                finalize: false
            };
        },
        setModal(reservation) {
            this.dataForm = reservation;
        },
        closeModal() {
            this.dataForm = null;
            this.refresh();
        },
        reset() {
            this.loading = false;
            this.dataForm = null;
        },
        selectZone(zone) {
            this.selectedZone = zone;
            this.refresh();
        }
    },
    mounted() {
        this.refreshAll();
    }
}
</script>

<style scoped lang="scss">

$selected: rgb(54 47 120 / 1);

.zone-list {
    button {
        border-radius: 0;
        border-bottom: 4px solid white;
    }

    button:hover {
        background: #f1ecff;
        color: rgba($selected, 1);
        border-bottom: 4px solid rgba($selected, 0.5);
    }

    .selected {
        border-bottom: 4px solid $selected;

        :hover div {
            color: white;
        }

        div {
            color: $selected;
            font-weight: 900;
        }
    }
}
</style>
