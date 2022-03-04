<template>
    <div>
        <small>{{ elapsedTime }}</small>
    </div>
</template>

<script>
import moment from 'moment'

export default {
    props: {
        from: {
            type: String,
        },
        to: {
            type: String,
        },
        period: {
            type: Number,
            default: 10
        },
        full: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            elapsedTime: 0,
            interval: null,
        }
    },
    watch: {
        period() {
            this.init();
        }
    },
    computed: {
        format() {
            return {
                hours: this.$t(this.full ? 'hours' : 'h'),
                minutes: this.$t(this.full ? 'minutes' : 'm'),
            }
        }
    },
    methods: {
        init() {
            this.stop();
            this.set();
        },
        set() {
            this.setElapsedTime();
            if (!this.to) {
                const intervalPeriod = 1000 * (this.period >= 10 ? this.period : 10);
                this.interval = setInterval(() => this.setElapsedTime(), intervalPeriod);
            }
        },
        stop() {
            if (this.interval) clearInterval(this.interval);
            this.interval = null;
        },

        setElapsedTime() {
            const duration = moment.duration(
                this.endTime().diff(this.startTime())
            );

            let space = this.full ? ' ': '';
            const totalHours = parseInt(duration.asHours().toString());
            const minutes = parseInt(duration.minutes().toString());

            this.$emit('elapsed', duration.asMinutes());

            if (totalHours) {
                if(totalHours < 999) {
                    this.elapsedTime = `${totalHours}${space}${this.format.hours} ${minutes}${space}${this.format.minutes}`;
                } else {
                    this.elapsedTime = `${totalHours}${space}${this.format.hours}...`;
                }
            } else {
                this.elapsedTime = `${minutes}${space}${this.format.minutes}`;
            }
        },

        startTime() {
            return moment(this.from);
        },
        endTime() {
            return this.to ? moment(this.to) : moment();
        }
    },
    mounted() {
        this.init();
    },
    unmounted() {
        this.stop();
    },
}
</script>

<style scoped>

</style>
