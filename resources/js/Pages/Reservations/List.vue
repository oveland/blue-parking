<template>
    <div>
        <div class="bg-white grid 2xl:rounded-3xl">
            <div class="px-6 py-5">
                <div class="grid grid-cols-3 items-center">
                    <div>
                        <div class="text-lg cursor-pointer flex items-center" @click="refresh">
                            <div class="float-left animate-pulse mr-2">
                                <icon name="loading" v-if="loading"></icon>
                                <icon name="reservation" v-if="!loading"></icon>
                            </div>
                            <div class="font-bold">
                                {{ $t('Reservations') }}
                            </div>
                        </div>
                        <div>
                            <small class="text-gray-400">{{ list.length }} {{ $t('In total') }}</small>
                        </div>
                    </div>

                    <div class="text-center">
                        <jet-button :disabled="disable" @click="add()">
                            {{ $t('Create') }}
                        </jet-button>
                    </div>

                    <div></div>
                </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 hidden">
                    {{ $t('Description') }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <jet-table v-if="list.length">
                    <template #head>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
                                {{ $t('Vehicle') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm text-gray-400 uppercase">
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
                                                @complete="setModal"
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

        <jet-dialog-modal :show="showModalForm" @close="closeModal" width="md">
            <template #title>
                <h1>
                    <span v-if="dataForm.create">{{ $t('Create') }}</span>
                    <span v-if="dataForm.edit">{{ $t('Edit') }}</span>
                    <span class="ml-1">{{ $t('Reservation') }}</span>
                </h1>
            </template>
            <template #content>
                <reservation-form :reservation.sync="dataForm" @refresh="refresh" @close="dataForm = null"></reservation-form>
            </template>
        </jet-dialog-modal>

        <jet-dialog-modal :show="showModalComplete" @close="closeModal" width="md">
            <template #title>
                <h1>
                    <span>{{ $t('Terminate') }}</span> <span class="ml-1">{{ $t('Reservation') }}</span>
                </h1>
            </template>
            <template #content>
                <reservation-form :reservation.sync="dataForm" @refresh="refresh" @close="dataForm = null"></reservation-form>
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

export default {
    props: {},
    created() {
        this.refresh();
    },
    data() {
        return {
            list: [],
            loading: false,
            dataForm: {
                create: false,
                edit: false,
            }
        }
    },
    components: {
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
        ReservationDetail
    },
    computed: {
        showModalForm() {
            return this.dataForm && (this.dataForm.create || this.dataForm.edit);
        },
        showModalComplete() {
            return this.dataForm && this.dataForm.complete;
        },
        disable() {
            return this.showModalForm || this.loading;
        },
        sortedList() {
            return _.sortBy(this.list, 'start');
        }
    },
    methods: {
        refresh() {
            this.loading = true;
            axios.get(route('reservations.show', {reservation: 'all'})).then(response => {
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
                complete: false
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
        }
    }
}
</script>

<style scoped>

</style>
