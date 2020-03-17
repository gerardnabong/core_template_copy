<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 text-center">
                <data-table
                    class="payment-schedule"
                    :columns="columns"
                >
                    <!-- this will overide/remove the search and dropdown for data-table size -->
                    <div slot="filters"></div>
                    //TODO will fix the sort order
                    <thead
                        slot="header"
                        slot-scope="{ tableProps }"
                        :style="{'background-color': portfolio.button_color}"
                    >
                        <tr>
                            <th
                                v-for="column in columns"
                                :key="column.name"
                                @click="sort(column.name,tableProps)"
                                :class="{'pl-5': column.name == 'id'}"
                            >
                                {{column.label}}
                            </th>
                        </tr>
                    </thead>
                    <tbody slot="body">
                        <tr
                            v-for="paymentSchedule in paymentSchedules"
                            :key="paymentSchedule.id"
                        >
                            <td class="pl-5">{{paymentSchedule.id}}</td>
                            <td>{{paymentSchedule.date}}</td>
                            <td>${{paymentSchedule.total}}</td>
                            <td>{{paymentSchedule.mode}}</td>
                        </tr>
                        <tr>
                            <td class="pl-5">#</td>
                            <td>Date</td>
                            <td>Total</td>
                            <td>Mode</td>
                        </tr>
                    </tbody>
                </data-table>

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
            // required prop of datatable
            columns: [
                {
                    label: '#',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Date',
                    name: 'date',
                    orderable: true,
                },
                {
                    label: 'Total',
                    name: 'total',
                    orderable: true,
                },
                {
                    label: 'Mode',
                    name: 'mode',
                    orderable: true,
                },
            ],
            //TODO needed the API for the data to display or the sample json file
            paymentSchedules: [
                { 'id': 1, 'date': 'March 1, 2020', 'total': '1000.00', 'mode': 'Default (ACH)' },
                { 'id': 2, 'date': 'March 2, 2020', 'total': '2000.00', 'mode': 'Default (ACH)' },
            ],
            sortOrders: {},
        }
    },

    mounted () {
        this.columns.forEach((column) => {
            this.sortOrders[column.name] = -1;
        });
    },

    methods: {
        sort (key, tableProps) {
            console.log(key, tableProps);
            tableProps.column = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            tableProps.dir = this.sortOrders[key] === 1 ? 'desc' : 'asc';
        }
    },

    created () {
        this.portfolio = this.$jsVars.portfolio;
    },

};
</script>
