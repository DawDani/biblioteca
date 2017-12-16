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
                                            v-model="ranges.max"
                                            :bootstrapStyling="true"
                                            :input-class="'form-control'"
                                            :calendar-class="'w-100'"
                                            :disabled="ranges"
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
        props: ['lockDays', 'isbn'],
        data() {
            return {
                ranges: {
                    to: new Date(),
                    max: new Date(),
                },
                reservationDate: new Date()
            }
        },
        computed: {
            reservationDay: function () {
                return this.ranges.max.toISOString().split("T")[0];
            },
        },
        components: {
            datepicker
        },
        mounted: function () {
            axios.get('/actions/getBlockedDates.php', {
                params: {
                    isbn: this.isbn
                }
            }).then(response => {
                if (response.data.needBlock) {
                    let blocks = {
                        to: new Date(),
                        ranges: []
                    };
                    let max = new Date();
                    response.data.ranges.forEach(function (e, i) {
                        if (new Date(e.to) > max) {
                            let asd = new Date(e.to);
                            max.setDate(asd.getDate() + 1)
                        }
                        blocks.ranges.push({
                            from: moment(e.from).add(1, 'days').toDate(),
                            to: moment(e.to).add(1, 'days').toDate(),
                        })
                    });
                    blocks.max = max;
                    this.ranges = blocks;
                }
            }).catch(error => {
                console.error(error);
            })
        }
    }
</script>

<style scoped>

</style>