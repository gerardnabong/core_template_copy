<template>
    <div>
        <header-client-portal />
        <div>
            <div class="col-12 text-center client-portal-container">
                <router-view />
            </div>
        </div>
        <footer-client-portal />
    </div>
</template>
<script>
import HeaderClientPortal from "~/components/templates/Header";
import FooterClientPortal from "~/components/templates/Footer";

export default {
    name: "Index",
    components: {
        HeaderClientPortal,
        FooterClientPortal
    },
    data() {
        return {
            portfolio: []
        };
    },
    created() {
        $.ajax({
            url: "getPortfolio",
            type: "get",
            async: false
        }).done(response => {
            this.$store.commit("setPortfolio", response);
        });
    }
};
</script>
