<template>
    <form @keypress.enter="save" @submit.prevent="save">
        <div class="grid gap-4">
            <parking-type v-for="type in parkingTypes" :type="type" @select="selectParkingType($event)" :selected="isSelectedType(type)"></parking-type>
            <jet-input-error :message="form.errors.parkingType" class="mt-1 ml-14 clear-both"/>

            <jet-input ref="focus" v-model="form.vehicle.plate" :placeholder="$t('Plate')" :uppercase="true"></jet-input>
            <jet-input v-model="form.vehicle.model" :placeholder="$t('Model')" :uppercase="true"></jet-input>
            <jet-input v-model="form.vehicle.color" :placeholder="$t('Color')" :uppercase="true"></jet-input>
            <jet-input v-model="form.vehicle.user.name" :placeholder="$t('Client')" :uppercase="true"></jet-input>
            <jet-select v-model="form.zone" :options="form.parkingType.availableZones" label="code" track-by="id" icon="point" :placeholder="$t('Zone')" @input="changeZone"></jet-select>
        </div>

        <div class="grid text-center mt-4">
            <div class="flex gap-4 mx-auto items-center">
                <jet-button @click.prevent="$emit('close');" color="transparent" :disabled="form.processing">
                    {{ $t('Cancel') }}
                </jet-button>

                <jet-button color="indigo" :disabled="form.processing && false">
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
        load() {
            axios.get(route('parking-types.show', {'parking_type': 'all'})).then(response => {
                this.parkingTypes = response.data
                this.selectParkingType(this.form.parkingType?.id ? this.form.parkingType : _.first(this.parkingTypes));
            });
        },
        selectParkingType(type) {
            this.form.parkingType = type;
        },
        isSelectedType(type) {
            return type.id === this.form.parkingType.id || (type.version === this.form.parkingType.version) && type.version
        },
        save() {
            console.log('Saving');
            if (this.form.create) {
                this.form.post(route('reservations.store'), {
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
            }
        },
        done() {
            if (!this.form.hasErrors) {
                this.$emit('close');
                this.$emit('refresh');
            }
        },
        changeZone(data) {
            console.log('changeZone = ', data);
            this.form.zone = data;
        }
    },
    mounted() {
        this.load();

        setTimeout(() => {
            this.$refs.focus?.focus();
        }, 500);
    }
}
</script>

<style scoped>

</style>
