<template>
    <div>
        {{ elapsedTime }}
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
        }
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
    methods: {
        init() {
            this.stop();
            this.set();
        },
        set() {
            this.setElapsedTime();
            if (!this.to) {
                this.interval = setInterval(() => this.setElapsedTime, 1000 * (this.period >= 10 ? this.period : 10));
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

            const totalHours = parseInt(duration.asHours().toString());
            const minutes = parseInt(duration.minutes().toString());

            if (totalHours) {
                this.elapsedTime = `${totalHours} ${this.$t('hours')} ${minutes} ${this.$t('minutes')}`;
            } else {
                this.elapsedTime = `${minutes} ${this.$t('minutes')}`;
            }
        },

        startTime() {
            return moment(this.from);
        },
        endTime() {
            return this.to ? moment(this.to) : moment();
        }
    },
    created() {
        this.init();
    }
}
</script>

<style scoped>

</style>
