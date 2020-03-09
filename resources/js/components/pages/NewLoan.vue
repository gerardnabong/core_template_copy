<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8 text-center pt-4">
                <span class="icon-like-icon client-portal-icon" :style="iconStyle"></span>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 text-center pt-4">
                <h2
                    class="client-portal-heading-text"
                >Congratulations! You're qualified for a new loan!</h2>
                <div class="mt-5">
                    <p>Click the button to apply</p>
                    <b-button
                        class="client-portal-btn-primary"
                        :style="buttonStyle"
                    >Request for New Loan</b-button>
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
<style lang="scss">
.icon-like-icon {
    font-size: 100px;
    &::before {
        color: var(--color);
    }
}
.client-portal-btn-primary {
    background-color: var(--background-color);
    &:hover {
        background-color: var(--background-hover-color);
    }
}
</style>
