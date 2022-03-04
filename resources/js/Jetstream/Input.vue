<template>
    <input class="jet-input form-input caret-pink-500 rounded-md focus:border-blue-100 shadow text-sm px-3 py-2 h-10 w-full font-extrabold text-gray-500" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
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
</style>

