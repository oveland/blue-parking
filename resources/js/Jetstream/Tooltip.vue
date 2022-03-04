<template>
    <div ref="button" @mouseenter="show" @focus="show" @mouseleave="hide" @blur="hide" aria-describedby="tooltip">
        <slot></slot>

        <div v-show="showTitle" ref="popper" class="tooltip">
            <span class="text-white text-sm">
                <slot name="data"></slot>
            </span>
            <div class="arrow" data-popper-arrow></div>
        </div>
    </div>
</template>

<script>
import {createPopper} from '@popperjs/core';

export default {
    props: {
        placement: {
            type: String,
            default: 'bottom'
        },
        showTitle: {
            type: Boolean,
            default: true,
        }
    },
    data() {
        return {
            popperInstance: null,
        }
    },
    computed: {},
    methods: {
        create() {
            this.popperInstance = createPopper(this.$refs.button, this.$refs.popper, {
                placement: this.placement,
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                ],
            });
        },
        destroy() {
            if (this.popperInstance) {
                this.popperInstance.destroy();
                this.popperInstance = null;
            }
        },
        show() {
            this.$refs.popper.setAttribute('data-show', '');
            this.create();
        },
        hide() {
            this.$refs.popper.removeAttribute('data-show');
            this.destroy();
        }
    }
}

</script>

<style>
.tooltip {
    background: #333;
    color: white;
    font-weight: bold;
    padding: 4px 8px;
    font-size: 13px;
    border-radius: 4px;
    display: none;
    width: max-content;
}

.tooltip[data-show] {
    display: block;
}

.arrow,
.arrow::before {
    position: absolute;
    width: 8px;
    height: 8px;
    z-index: -1;
}

.arrow::before {
    content: '';
    transform: rotate(45deg);
    background: #333;
}

.tooltip[data-popper-placement^='top'] > .arrow {
    bottom: -4px;
}

.tooltip[data-popper-placement^='bottom'] > .arrow {
    top: -4px;
}

.tooltip[data-popper-placement^='left'] > .arrow {
    right: -4px;
}

.tooltip[data-popper-placement^='right'] > .arrow {
    left: -12px;
}
</style>
