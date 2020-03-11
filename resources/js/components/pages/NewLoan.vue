<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <span class="icon-like-icon client-portal-icon" :style="iconStyle"></span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center pt-4">
                <h2
                    class="client-portal-heading-text"
                >Congratulations! You're qualified for a new loan!</h2>
                <div class="mt-5">
                    <p>Click the button to apply</p>
                    <b-button
                        class="client-portal-btn-primary w-100 mt-3 py-2"
                        :style="buttonStyle"
                    >Request for New Loan</b-button>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 col-sm-4 text-center mt-5">
                <div class="card call-us-background p-4 client-portal-border-none">
                    <div class="row">
                        <div class="col-4 align-self-center font-size-40">
                            <i class="fas fa-phone fa-rotate-90 color-override" :style="iconStyle"></i>
                        </div>
                        <div class="col-8">
                            <div class="row flex-column text-left">
                                <div class="col font-size-17">Call us at</div>
                                <div class="col font-size-22 font-weight-bold">
                                    <a
                                        href="tel:+18555734504"
                                        class="text-decoration-none color-black"
                                    >1-855-573-4504</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
"use strict";

export default {
    name: "NewLoan",

    computed: {
        iconStyle() {
            return {
                "--color": this.$store.state.portfolio.button_color
            };
        },
        buttonStyle() {
            return {
                "--background-color": this.$store.state.portfolio.button_color,
                "--background-hover-color": this.$store.state.portfolio
                    .button_hover_color
            };
        }
    }
};
</script>
