<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 text-center">
                <h2 class="client-portal-heading-text my-4">Payment Schedule</h2>
                <b-table
                    :items="paymentSchedules"
                    :fields="paymentTableColumns"
                    striped
                    hover
                    thead-tr-class="payment-schedule-tr"
                    table-class="payment-schedule payment-schedule-border"
                    tbody-class="payment-schedule-tbody"
                    responsive="sm"
                >
                </b-table>

            </div>
        </div>
        <div class="d-flex justify-content-center">
            <router-link
                to="/loan-action"
                class="btn payment-schedule-btn-back"
            >
                Back
            </router-link>
        </div>
    </div>
</template>

<script>
'use strict';

export default {
    name: 'PaymentSchedule',
    data () {
        return {
            //TODO needed the API for the data to display or the sample json file
            paymentSchedules: [
                { 'id': 1, 'date': 'March 1, 2020', 'total': '$1000.00', 'mode': 'Default (ACH)' },
                { 'id': 2, 'date': 'March 2, 2020', 'total': '$2000.00', 'mode': 'Default (ACH)' },
            ],

        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
        var headerStyleLeft = {
            'background-color': this.portfolio.button_color,
            'color': 'white',
            'border-radius': '8px 0 0 0',
            'padding-left': '30px',
        };
        var headerStyleCenter = {
            'background-color': this.portfolio.button_color,
            'color': 'white',
        };
        var headerStyleRight = {
            'background-color': this.portfolio.button_color,
            'color': 'white',
            'border-radius': '0 8px 0 0',
        };
        this.paymentTableColumns = [
            {
                label: '#',
                key: 'id',
                sortable: true,
                thStyle: headerStyleLeft,
            },
            {
                label: 'Date',
                key: 'date',
                sortable: true,
                thStyle: headerStyleCenter,
            },
            {
                label: 'Total',
                key: 'total',
                sortable: true,
                thStyle: headerStyleCenter,
            },
            {
                label: 'Mode',
                key: 'mode',
                sortable: true,
                thStyle: headerStyleRight,
            },
        ];
    },

};
</script>
