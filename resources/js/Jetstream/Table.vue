<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="overflow-x-scroll">
            <div class="inline-block py-2 min-w-full">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
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

