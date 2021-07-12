<template>
    <jet-button @click.native="confirmDelete = true" color="transparent">
        {{ $t('Delete') }}

        <!-- Delete Account Confirmation Modal -->
        <jet-confirmation-modal :show="confirmDelete" @close="confirmDelete = false">
            <template #title>
                {{ $t('Delete') }} {{ $t('reservation') }}
            </template>

            <template #content>
                <p>{{ $t('Are you sure you want to delete this reservation?') }}: {{ reservation.id }}</p>

                <jet-section-border/>
            </template>

            <template #footer>
                <jet-button @click.native="confirmDelete = false" color="transparent">
                    {{ $t('Cancel') }}
                </jet-button>

                <jet-button class="ml-2" @click.native="destroy" color="red" :class="{ 'opacity-25': form.processing }" :disabled="disabled">
                    {{ $t('Delete') }}
                </jet-button>
            </template>
        </jet-confirmation-modal>
    </jet-button>
</template>

<script>
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSectionBorder from '@/Jetstream/SectionBorder'

export default {
    props: {
        reservation: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            confirmDelete: false,
            form: this.$inertia.form(this.reservation, {
                bag: 'destroyReservation',
                resetOnSuccess: false,
            })
        }
    },
    components: {
        JetInput,
        JetButton,
        JetSecondaryButton,
        JetDangerButton,
        JetSectionBorder,
        JetConfirmationModal,
    },
    computed: {
        disabled() {
            return this.form.processing;
        },
        enabled() {
            return !this.disabled;
        }
    },
    methods: {
        destroy() {
            if (this.enabled) {
                this.form.delete(route('reservations.destroy', this.reservation), {
                    preserveScroll: true,
                    onSuccess: () => {
                        if (!this.form.hasErrors()) {
                            this.confirmDelete = false
                        }
                    }
                })
            }
        }
    }
}
</script>

<style scoped>

</style>
