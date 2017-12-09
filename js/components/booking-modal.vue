<template>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelTitleId">Reserve book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" id="modalDates">
                            <div class="form-group">
                                <label for="picker">Date</label>
                                <datepicker id="picker"
                                            v-model="reservationDate"
                                            :bootstrapStyling="true"
                                            :input-class="'form-control'"
                                            :calendar-class="'w-100'"
                                            :disabled="blocks"
                                >
                                </datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="modal-footer" action="reserveProcess.php" method="post">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                <input type="hidden" name="reservationDay" :value="reservationDay">
                <input type="hidden" name="isbn" :value="isbn">
            </form>
        </div>
    </div>
</template>

<script>
    import datepicker from 'vuejs-datepicker';

    export default {
        name: "booking-modal",
        props: ['disabled', 'lockDays', 'isbn', 'ranges'],
        data() {
            return {
                reservationDate: new Date()
            }
        },
        computed: {
            reservationDay: function () {
                return this.reservationDate.toISOString().split("T")[0];
            },
            blocks: function () {
                if (this.ranges !== undefined) {
                    return {
                        to: new Date(),
                        ranges: this.ranges,
                    }
                } else {
                    return {
                        to: new Date(),
                    }
                }
            }
        },
        components: {
            datepicker
        }
    }
</script>

<style scoped>

</style>