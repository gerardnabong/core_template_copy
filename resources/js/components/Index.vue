<template>
    <div class="container-fluid">
        <div class="row">
            <header-client-portal />
        </div>
        <div class="row">
            <div class="col-12 text-center"></div>
        </div>
        <div class="row">
            <footer-client-portal />
        </div>
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
    }
};
</script>
