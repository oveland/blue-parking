<template>
    <form @keypress.enter="save" @submit.prevent="save">
        <div class="grid gap-4">
            <parking-type v-for="type in parkingTypes" :type="type" @select="selectParkingType" :selected="isSelectedType(type)" :reservation="reservation"></parking-type>
            <jet-input-error :message="form.errors.type" class="clear-both text-xs font-bold"/>

            <jet-input ref="focus" v-model="form.vehicle.plate" :placeholder="$t('Plate')" :uppercase="true"></jet-input>
            <jet-input-error :message="form.errors['vehicle.plate']" class="clear-both text-xs font-bold"/>

            <jet-input v-model="form.vehicle.model" :placeholder="$t('Model')" :uppercase="true"></jet-input>
            <jet-input v-model="form.vehicle.color" :placeholder="$t('Color')" :uppercase="true"></jet-input>
            <jet-input v-model="form.vehicle.user.name" :placeholder="$t('Client')" :uppercase="true"></jet-input>

            <jet-select v-model="form.zone" :options="form.type.availableZones" label="code" track-by="code" icon="point" :placeholder="$t('Zone')"></jet-select>
            <jet-input-error :message="form.errors['zone.id']" class="clear-both text-xs font-bold"/>
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

            style: {
                container: 'relative cursor-pointer border-0 bg-white text-base leading-snug outline-none jet-input form-input rounded-md focus:border-indigo-100 shadow text-sm px-3 py-2 h-10 w-full text-xs',
                containerDisabled: 'cursor-default bg-gray-100',
                containerOpen: 'rounded-b-none',
                containerOpenTop: 'rounded-t-none',
                containerActive: 'ring ring-green-500 ring-opacity-30',
                singleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-xs',
                multipleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-xs',
                search: 'jet-input w-full absolute inset-0 outline-none appearance-none box-border border-0 text-base font-sans bg-white rounded pl-3',
                tags: 'flex-grow flex-shrink flex flex-wrap mt-1 pl-2',
                tag: 'bg-green-500 text-white text-xs font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap',
                tagDisabled: 'pr-2 !bg-gray-400 text-white',
                tagRemove: 'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
                tagRemoveIcon: 'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
                tagsSearch: 'h-full border-0 outline-none appearance-none p-0 text-base font-sans mx-1 mb-1 box-border flex-grow flex-shrink',
                placeholder: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-gray-400 text-xs',
                caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3 relative z-10 opacity-40 flex-shrink-0 flex-grow-0 transition-transform transform',
                caretOpen: 'rotate-180',
                clear: 'pr-3 z-10 mt-1 opacity-40 transition duration-300 hover:opacity-100 float-right rounded-full bg-green-400 hover:bg-red-400 h-4 w-4',
                clearIcon: 'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
                spinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3 animate-spin flex-shrink-0 flex-grow-0',
                dropdown: 'absolute -left-px -right-px bottom-0 transform translate-y-full border border-gray-300 -mt-px overflow-y-scroll z-50 bg-white flex flex-col rounded-b',
                dropdownTop: '-translate-y-full top-px bottom-auto flex-col-reverse rounded-b-none rounded-t',
                options: 'flex flex-col p-0 m-0 list-none',
                optionsTop: 'flex-col-reverse',
                option: 'flex items-center justify-start box-border text-left cursor-pointer leading-snug py-2 px-3 text-xs',
                optionPointed: 'text-white bg-indigo-600',
                optionSelected: 'text-white bg-indigo-800',
                optionDisabled: 'text-gray-300 cursor-not-allowed',
                optionSelectedPointed: 'text-white bg-indigo-800 opacity-90',
                optionSelectedDisabled: 'text-indigo-100 bg-indigo-500 bg-opacity-50 cursor-not-allowed',
                noOptions: 'py-2 px-3 text-gray-500 bg-white',
                noResults: 'py-2 px-3 text-gray-500 bg-white',
                fakeInput: 'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
                spacer: 'h-9 py-px box-content',
            }
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
        load() {
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
