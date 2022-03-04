<template>
    <label class="inline-block font-medium text-sm text-gray-700" @click="$emit('click')">
        <span class="flex items-center" v-if="value">{{ value }}</span>
        <span class="flex items-center" v-else><slot></slot></span>
    </label>
</template>

<script>
export default {
    props: ['value']
}
</script>
