<template>
    <b-button
        :class="buttonProperty.class"
        :style="{'background-color' : (hover ? buttonProperty.hover_color : buttonProperty.color)}"
        @click="buttonClick"
        @mouseover="hover = true"
        @mouseleave="hover = false"
    >{{buttonProperty.name}}</b-button>
</template>

<script>
export default {
    name: "CLientPortalPrimaryButton",
    props: ["buttonProperty"],
    data() {
        return {
            hover: false
        };
    },
    methods: {
        buttonClick(e) {
            this.$emit("buttonClick");
        }
    }
};
</script>
