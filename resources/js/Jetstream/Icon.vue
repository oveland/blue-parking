<template>
    <span :class="fillColor" @click="$emit('click', $event)">
        <component :is="iconComponent" :class="`h-${height} w-${width}`" :light="fillColorLight"></component>
        <slot></slot>
    </span>
</template>

<script>

import IconVehicle from '@/Icons/Vehicle';

import {defineAsyncComponent} from 'vue';

export default {
    props: {
        name: {
            type: String,
            required: true
        },
        color: {
            type: String,
            default: 'gray'
        },
        density: {
            type: [Number, String],
            default: 600
        },
        h: {
            type: [Number, String],
            default: 6
        },
        w: {
            type: [Number, String],
            default: 6
        },
        size: {
            type: [Number, String],
            default: ""
        }
    },
    components: {
        IconVehicle
    },
    computed: {
        width() {
            return parseInt(this.size) ? this.size : this.w;
        },
        height() {
            return parseInt(this.size) ? this.size : this.h;
        },
        iconComponent() {
            return defineAsyncComponent(() => import(`@/Icons/${this.componentNameIcon()}`));
        },
        fillColor() {
            if (this.color === 'black') {
                return `text-${this.color}`;
            }
            return `text-${this.color}-${this.density}`;
        },
        fillColorLight() {
            let densityLight = this.density - 200;

            if (this.color === 'black' || this.color === 'blank') {
                return `text-gray-400`;
            }

            if (this.density > 200) {
                return `text-${this.color}-${densityLight}`;
            }

            return `text-${this.color}-50`;
        },
    },
    methods: {
        componentNameIcon() {
            let iconName = "";

            this.name.toLowerCase().split('-').map(section => {
                iconName += section.charAt(0).toUpperCase() + section.slice(1);
            });

            return iconName;
        }
    }
}
</script>
