<template>
    <div class="w-full shadow cursor-pointer rounded-xl" :class="mainColor + ' ' + textColor" @click="$emit('select', type)">
        <div class="flex gap-6 p-6">
            <div class="w-auto rounded-md p-3 text-center" :class="`bg-${vehicleType.color}-100`">
                <icon :name="vehicleType.icon" :color="vehicleType.color" h="8" w="8"></icon>
            </div>
            <div class="w-2/3">
                <span class="text-xl font-bold">
                    {{ vehicleType.name }}
                </span>
                <br>
                <span class="pt-2">{{ type.available }} {{ $t('available') }}</span>
            </div>
            <div class="w-auto float-right text-right font-bold">
                <span class="text-3xl">
                    ${{ type.tariff }}
                </span>
                <br>
                <span>{{ $t('minute') }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import Icon from '@/Jetstream/Icon'

export default {
    props: {
        type: Object,
        selected: Boolean | Number
    },
    components: {
        Icon
    },
    computed: {
        vehicleType() {
            return this.type.vehicleType;
        },
        mainColor() {
            return this.selected ? `bg-${this.vehicleType.color}-600` : 'white';
        },
        textColor() {
            return this.selected ? 'text-white' : 'text-gray-400';
        }
    }
}
</script>

<style scoped>

</style>
