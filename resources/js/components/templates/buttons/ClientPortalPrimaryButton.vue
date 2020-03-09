<template>
    <b-button
        :class="button_class"
        :style="{'background-color' : (hover ? color : hover_color)}"
        @click="buttonClick"
        @mouseover="hover = true"
        @mouseleave="hover = false"
    >{{button_name}}</b-button>
</template>

<script>
"use strict";
export default {
    name: "CLientPortalPrimaryButton",
    props: {
        color: { type: String, required: true },
        hover_color: { type: String, required: true },
        button_class: { type: Array, required: true },
        button_name: { type: String, required: true }
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
