<template>
    <inertia-link :href="link" class="inline-flex items-center px-5 py-4 transition duration-200 font-bold rounded-lg" :class="classes" :title="disabled ? 'En desarrollo... ' : ''">
        <icon v-if="icon" :name="icon" color="blank" class="mr-2"></icon>
        <slot></slot>
    </inertia-link>
</template>

<script>
    import Icon from '@/Jetstream/Icon';
    export default {
        props: ['href', 'active', 'icon', 'disabled'],
        components: {
            Icon
        },
        computed: {
            classes() {

                if(this.disabled){
                    return 'text-gray-200 opacity-50';
                }

                return this.active
                            ? 'text-white bg-blue-900 border-l-4 border-gray-200'
                            : 'text-gray-200 hover:text-blue-900 hover:bg-white'
            },
            link() {
                return this.disabled ? '' : this.href;
            }
        }
    }
</script>
