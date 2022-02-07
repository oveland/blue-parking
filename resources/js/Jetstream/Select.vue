<template>
    <div>
        <multiselect
            ref="multiselect"
            :id="id"
            v-model="value"
            :options="optionsSelect"
            class="multiselect-indigo"
            :classes="style"
            :searchable="searchable"
            :label="label"
            :track-by="trackBy"
            value-prop="id"
            :placeholder="placeholder"
            :multiple="multiple"
            :disabled="disabled"
            :loading="isLoading"
            :object="true"
            :native-support="true"
            :resolve-on-load="true"
        ></multiselect>
    </div>
</template>

<script>

import Multiselect from '@vueform/multiselect'
import Icon from '@/Jetstream/Icon'

export default {
    props: {
        options: {
            required: false,
            type: Array
        },
        trackBy: {
            required: true
        },
        label: {
            required: true
        },
        labelSm: {
            default: null
        },
        searchable: {
            type: Boolean,
            default: true,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        allowEmpty: {
            type: Boolean,
            default: false,
        },
        async: {
            type: Boolean,
            default: false
        },
        url: {
            type: String,
            default: null,
        },
        placeholder: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        },
        modelValue: {
            type: Object,
        },
        icon: String,
    },
    data() {
        return {
            id: Date.now(),
            isLoading: false,
            query: null,
            asyncOptions: [],
            style: {
                container: 'relative cursor-pointer border-0 bg-white text-base leading-snug outline-none jet-input form-input rounded-md focus:border-indigo-100 shadow text-sm px-3 py-2 h-10 w-full text-xs',
                containerDisabled: 'cursor-default bg-gray-100',
                containerOpen: 'rounded-b-none',
                containerOpenTop: 'rounded-t-none',
                containerActive: 'ring ring-green-500 ring-opacity-30',
                singleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-xs',
                multipleLabel: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-xs',
                search: 'jet-input w-full absolute inset-0 outline-none appearance-none box-border border-0 text-base font-sans bg-white rounded pl-3',
                tags: 'grow shrink flex flex-wrap mt-1 pl-2',
                tag: 'bg-green-500 text-white text-xs font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center whitespace-nowrap',
                tagDisabled: 'pr-2 !bg-gray-400 text-white',
                tagRemove: 'flex items-center justify-center p-1 mx-0.5 rounded-sm hover:bg-black hover:bg-opacity-10 group',
                tagRemoveIcon: 'bg-multiselect-remove bg-center bg-no-repeat opacity-30 inline-block w-3 h-3 group-hover:opacity-60',
                tagsSearch: 'h-full border-0 outline-none appearance-none p-0 text-base font-sans mx-1 mb-1 box-border grow shrink',
                placeholder: 'flex items-center h-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3 text-gray-400 text-xs',
                caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3 relative z-10 opacity-40 shrink-0 grow-0 transition-transform',
                caretOpen: 'rotate-180',
                clear: 'pr-3 z-10 mt-1 opacity-40 transition duration-300 hover:opacity-100 float-right rounded-full bg-green-400 hover:bg-red-400 h-4 w-4',
                clearIcon: 'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
                spinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3 animate-spin shrink-0 grow-0',
                dropdown: 'absolute -left-px -right-px bottom-0 translate-y-full border border-gray-300 -mt-px overflow-y-scroll z-50 bg-white flex flex-col rounded-b',
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
        options() {
            this.value = null;
            this.deselect();
        },
    },
    computed: {
        value: {
            get() {
                return this.modelValue && this.modelValue.id ? this.modelValue : {};
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        },
        placeholderStr() {
            return this.$t('Search') + (this.placeholder !== '' ? ` ${ this.placeholder }` : ` ${this.title}`).toLowerCase();
        },
        optionsSelect() {
            if (this.async && !this.query && !this.asyncOptions.length && this.value && this.value.length) {
                this.asyncOptions.push(this.value)
            }

            return this.async ? this.asyncOptions : this.options;
        },
    },
    methods: {
        deselect() {
            this.$refs.multiselect.deselect();
        },
        search(query) {
            this.query = query;

            if (this.async) {
                if (this.async && this.url && this.query && (this.query.length >= 2 || this.query === ' ')) {
                    this.isLoading = true

                    axios.get(this.url, {
                        params: {
                            query
                        }
                    }).then(response => {
                        this.isLoading = false
                        this.asyncOptions = JSON.parse(JSON.stringify(response.data))

                        if(!this.asyncOptions.length){
                            this.add(query);
                        }else {
                            this.add(null);
                        }
                    });
                }

                if (!this.query) {
                    this.asyncOptions = [];
                    this.add(null);
                }
            }
        }
    },
    components: {
        Icon,
        Multiselect
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style>
</style>
