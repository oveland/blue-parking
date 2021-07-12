<template>
    <span :class="fillColor" @click="$emit('click', $event)">
        <component :is="iconComponent" :class="`h-${h} w-${w}`" :light="fillColorLight"></component>
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
    },
    components: {
        IconVehicle
    },
    computed: {
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
            if (this.color === 'black' || this.color === 'blank') {
                return `text-gray-400`;
            }
            return `text-${this.color}-${this.density - 200}`;
        },
    },
    methods: {
        componentNameIcon() {
            let iconName = this.name.toLowerCase();
            return iconName.charAt(0).toUpperCase() + iconName.slice(1);
        }
    }
}
</script>
