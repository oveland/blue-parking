<template>
    <modal :show="show" :width="width" :closeable="closeable" @close="close">
        <div :class="clear ? '' : 'px-6 py-4'">
            <div class="text-lg">
                <slot name="title">
                </slot>
            </div>

            <div :class="clear ? '' : 'mt-4'">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div :class="clear || noFooter ? '' : 'px-6 py-4 bg-gray-100 text-right'">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        emits: ['close'],

        components: {
            Modal,
        },

        props: {
            clear: {
                default: false
            },
            show: {
                default: false
            },
            width: {
                default: 'md'
            },
            closeable: {
                default: true
            },
            noFooter: {
                default: false
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>
