<template>
    <div class="row no-gutters w-100 align-items-end">
        <div class="col-12 desktop-hide position-relative">
            <div class="client-portal-background-image">
                <img
                    class="w-100"
                    :src="'/images/'+this.$store.state.portfolio.wave_mobile_image"
                    alt
                />
            </div>
        </div>
        <div class="col-12 mobile-hide position-relative">
            <div class="client-portal-background-image">
                <img class="w-100" :src="'/images/'+this.$store.state.portfolio.wave_image" alt />
            </div>
        </div>
    </div>
</template>

<script>
// TODO This is only for vue template and will be remove later
export default {
    Name: "Footer"
};
</script>
