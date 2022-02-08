<template>
    <form @keypress.enter="save" @submit.prevent="save">
        <div class="grid gap-4" v-if="reservation">
            <parking-type v-for="type in parkingTypes" :type="type" @select="selectParkingType" :selected="isSelectedType(type)" :reservation="reservation"></parking-type>
            <jet-input-error :message="form.errors.type" class="clear-both text-xs font-bold"/>

            <jet-select ref="focus" v-model="form.zone" :options="form.type.availableZones" label="code" track-by="code" icon="point" :placeholder="$t('Zone')" :disabled="reservation.finalize"></jet-select>
            <jet-input-error :message="form.errors['zone.id']" class="clear-both text-xs font-bold"/>

            <jet-input v-model="form.vehicle.plate" :placeholder="$t('Plate')" :uppercase="true" :disabled="reservation.finalize"></jet-input>
            <jet-input-error :message="form.errors['vehicle.plate']" class="clear-both text-xs font-bold"/>

            <jet-input v-model="form.vehicle.model" :placeholder="$t('Model')" :uppercase="true" :disabled="reservation.finalize"></jet-input>
            <jet-input v-model="form.vehicle.color" :placeholder="$t('Color')" :uppercase="true" :disabled="reservation.finalize"></jet-input>
            <jet-input v-model="form.vehicle.user.name" :placeholder="$t('Client')" :uppercase="true" :disabled="reservation.finalize"></jet-input>
        </div>

        <div class="grid text-center mt-4">
            <div class="flex gap-4 mx-auto items-center">
                <jet-button @click.prevent="$emit('close');" color="transparent" :disabled="form.processing">
                    {{ $t('Cancel') }}
                </jet-button>

                <jet-button color="indigo" :disabled="form.processing">
                    {{ $t('Save') }}
                </jet-button>
            </div>
        </div>
    </form>
</template>

<script>
import Icon from '@/Jetstream/Icon'
import JetLabel from '@/Jetstream/Label'
import JetButton from '@/Jetstream/Button'
import JetLoading from '@/Jetstream/Loading'
import JetInput from '@/Jetstream/Input'
import JetCheck from '@/Jetstream/Check'
import JetSelect from '@/Jetstream/Select'
import JetInputError from '@/Jetstream/InputError'

import { useForm } from '@inertiajs/inertia-vue3'

import ParkingType from "@/Pages/Reservations/Form/ParkingType";

export default {
    props: {
        reservation: Object,
    },
    data() {
        return {
            form: useForm(this.reservation),
            parkingTypes: [],
        }
    },
    watch: {

    },
    components: {
        ParkingType,
        Icon,
        JetLabel,
        JetInput,
        JetCheck,
        JetButton,
        JetInputError,
        JetLoading,
        JetSelect
    },
    methods: {
        init() {
            axios.get(route('parking-types.show', {'parking_type': (this.form.create ? 'all' : this.form.type)})).then(response => {
                this.parkingTypes = response.data;
                this.form.type = this.form.type?.id ? this.form.type : _.first(this.parkingTypes);
            });
        },
        selectParkingType(type) {
            this.form.zone = null;
            this.form.type = type;
        },
        isSelectedType(type) {
            return (this.form.type && type.id === this.form.type.id) || (type.version && type.version === this.form.type.version)
        },
        save() {
            if (this.form.create) {
                this.form.post(route('reservations.open'), {
                    onSuccess: () => {
                        this.done()
                    },
                });
            } else if (this.form.edit) {
                this.form.put(route('reservations.update', this.reservation), {
                    onSuccess: () => {
                        this.done();
                    },
                });
            } else if (this.form.finalize) {
                this.form.put(route('reservations.finalize', this.reservation), {
                    onSuccess: () => {
                        this.done();
                    },
                });
            }
        },
        done() {
            if (!this.form.hasErrors) {
                this.$emit('close');
                this.$emit('refresh');
            }
        }
    },
    mounted() {
        this.init();

        setTimeout(() => {
            if (this.form.create)this.$refs.focus?.focus();
        }, 500);
    }
}
</script>

<style scoped>

</style>
