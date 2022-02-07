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
        <icon v-if="icon" :name="icon" color="gray" density="50" :class="onlyIcon ? '' : 'mr-2'" w="3" h="3"></icon>
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
        onlyIcon: false,
    },
    components: {
        Icon
    },
    computed: {
        textColor() {
            return this.color === 'transparent' ? 'text-gray-500' : 'text-white';
        },
        padding() {
            return this.color === 'transparent' ? 'px-0' : 'px-4';
        }
    }
}
</script>
