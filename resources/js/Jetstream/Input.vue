<template>
    <input class="jet-input form-input rounded-md focus:border-blue-100 shadow text-sm px-3 py-2 h-10 w-full text-xs" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

<style>
input.jet-input {
    border-color: #d3d3d378;
    font-size: 0.8rem;
}
</style>

