<template>
    <jet-label class="inline-flex items-center cursor-pointer py-2 align-middle">
        <input class="form-checkbox transition-all duration-500" :class="textColor"
               type="checkbox"
               v-bind:checked="checked"
               v-on:change="$emit('change', $event.target.checked)"
               :disabled="disabled"
               @input="$emit('input', $event.target.value)" ref="input">

        <span class="ml-2" :class="{'font-bold': !disabled, 'text-black': !disabled, 'text-gray-700': disabled}">
            <slot></slot>
        </span>
    </jet-label>
</template>

<script>
import JetLabel from "@/Jetstream/Label";

export default {
    model: {
        prop: 'checked',
        event: 'change'
    },
    props: {
        checked: Boolean,
        color: {
            type: String,
            default: 'black'
        },
        density: {
            type: Number,
            default: 500
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        densityColor() {
            return this.disabled ? this.density : 700;
        },
        textColor() {
            if (this.color === 'black') {
                return `text-${this.color}`;
            }
            return `text-${this.color}-${this.densityColor}`;
        }
    },
    components: {
        JetLabel
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
