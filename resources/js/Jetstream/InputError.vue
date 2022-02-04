<template>
    <div v-if="message">
        <p class="text-sm text-red-600 ml-3">
            {{ $t(message) }}
        </p>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
