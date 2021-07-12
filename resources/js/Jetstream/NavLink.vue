<template>
    <inertia-link :href="href" class="inline-flex items-center px-5 py-4 transition duration-200 font-bold rounded-lg" :class="classes">
        <icon v-if="icon" :name="icon" color="blank" class="mr-2"></icon>
        <slot></slot>
    </inertia-link>
</template>

<script>
    import Icon from '@/Jetstream/Icon';
    export default {
        props: ['href', 'active', 'icon'],
        components: {
            Icon
        },
        computed: {
            classes() {
                return this.active
                            ? 'text-white bg-blue-900 border-l-4 border-gray-200'
                            : 'text-gray-200 hover:text-blue-900 hover:bg-white'
            }
        }
    }
</script>
