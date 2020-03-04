
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="customer-portal-header">header</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="customer-portal-content">{{this.getCount}}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="customer-portal-footer">
                    <button @click="addCounter">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// TODO this is a sample code for vueX will replace with actual codes for the project
import counter from "../components/";

export default {
    computed: {
        getCount() {
            return this.$store.getters.getCount;
        }
    },
    methods: {
        addCounter() {
            this.$store.commit("incrementCount");
        }
    }
};
</script>
