<template>
    <datepicker v-model="date"
                :selectText="$t('Select')"
                locale="es"
                :nowButtonLabel="$t('Today')"
                autoApply
                :placeholder="$t('Date')"
                showNowButton
                :enableTimePicker="false"
                :dark="true"
                :clearable="false"
                :format="format"
    ></datepicker>
</template>

<script>
import Datepicker from 'vue3-date-time-picker'
import 'vue3-date-time-picker/dist/main.css'

import moment from 'moment'

export default {
    props: ['value'],
    components: {Datepicker},
    data() {
        return {
            date: null,
        };
    },
    computed: {

    },
    methods: {
        format() {
            console.log(this.date, this.value);
            return moment(this.date).format("YYYY-MM-DD")
        },
        select() {
            this.$emit('input', this.date);
        }
    }
}
</script>

<style>
.dp__input{
    background-color: white !important;
    color: gray !important;
    border: 1px solid lightgray;
}
</style>
