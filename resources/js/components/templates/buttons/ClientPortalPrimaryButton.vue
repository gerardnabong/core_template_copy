<template>
    <b-button
        :class="buttonClass"
        :style="{'background-color' : (hover ? color : hoverColor)}"
        @click="buttonClick"
        @mouseover="hover = true"
        @mouseleave="hover = false"
    >{{buttonName}}</b-button>
</template>

<script>
"use strict";

export default {
    name: "CLientPortalPrimaryButton",

    props: {
        color: { type: String, required: true },
        hoverColor: { type: String, required: true },
        buttonClass: { type: Array, required: true },
        buttonName: { type: String, required: true }
    },

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
