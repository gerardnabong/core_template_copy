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
            </div>
        </div>
    </div>
</template>

<script>
import ClientPortalPrimaryButton from "~/components/templates/buttons/ClientPortalPrimaryButton";
export default {
    name: "NewLoan",
    components: {
        ClientPortalPrimaryButton
    },
    computed: {
        iconStyle() {
            return {
                "--color": this.$store.state.portfolio.button_color
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
</style>
