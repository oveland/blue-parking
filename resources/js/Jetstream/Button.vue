<template>
    <button :type="type" :disabled="disabled" @click="$emit('click', $event)"
            class="inline-flex items-center py-2 border border-transparent rounded-md font-semibold text-xs tracking-widest focus:outline-none transition ease-in-out duration-200 uppercase"
            :class="`
                bg-${ color }-700 hover:bg-${ color }-600 active:bg-${ color }-900 focus:border-${ color }-900
                focus:shadow-outline-${ color }
                ${ padding }
                ${ textColor }
                ${ disabled ? 'opacity-25' : '' }
                h-${ h }`
            ">
        <icon v-if="icon" :name="icon" :color="colorIcon" :density="densityIcon" :class="onlyIcon ? '' : 'mr-2'" :size="sizeIcon"></icon>
        <slot></slot>
    </button>
</template>

<script>
import Icon from '@/Jetstream/Icon'

export default {
    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
        type: {
            type: String,
            default: 'submit',
        },
        color: {
            type: String,
            default: 'gray',
        },
        h: {
            type: [Number, String],
            default: 10
        },
        icon: {
            type: String,
            required: false
        },
        sizeIcon: {
            type: [Number, String],
            default: 3
        },
        colorIcon: {
            type: [String],
            default: 'gray'
        },
        onlyIcon: false,
    },
    components: {
        Icon
    },
    computed: {
        textColor() {
            return this.isTransparent ? 'text-gray-500' : 'text-white';
        },
        padding() {
            return this.isTransparent ? 'px-0' : 'px-4';
        },
        densityIcon() {
            return this.isTransparent ? 400 : 50;
        },
        isTransparent() {
            return this.color === 'transparent';
        }
    }
}
</script>
