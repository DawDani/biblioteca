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
                                            :bootstrapStyling="true"
                                            :input-class="'form-control'"
                                            :calendar-class="'w-100'"
                                            :disabled="disabledDates"
                                >
                                </datepicker>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import datepicker from 'vuejs-datepicker';

    export default {
        name: "booking-modal",
        props: ['disabled','lockDays'],
        data() {
            return {
                disabledDates: {
                    ranges: [
                        {
                            from: new Date(2017, 11, 12),
                            to: new Date(2017, 11, 21),
                        },
                        {
                            from: new Date(2017, 11, 21),
                            to: new Date(2017, 11, 26),
                        },
                    ]
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