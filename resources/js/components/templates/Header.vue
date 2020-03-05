<template>
    <div class="row">
        <div class="container-fluid">
            <div class="col-12">{{this.getPortfolio}}</div>
        </div>
    </div>
</template>

<script>
// TODO This is only for vue template and will be remove later
export default {
    Name: "Header",
    computed: {
        getPortfolio() {
            return this.$store.getters.getPortfolio;
        }
    }
};
</script>
