<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="z-50">
        <div class="sm:-mx-6 lg:-mx-8">
            <div class=" align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-200 relative overflow-x-auto">
                    <thead class="bg-gray-50">
                        <slot name="head"></slot>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <slot name="body"></slot>
                    </tbody>
                    <tfoot class="divide-y divide-gray-200">
                        <slot name="footer"></slot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [],
    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>

