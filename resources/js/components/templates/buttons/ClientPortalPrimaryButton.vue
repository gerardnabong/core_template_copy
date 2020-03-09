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
    // ["color", "hover_color", "button_class", "button_name"],
    props: {
        color: String,
        hover_color: String,
        button_class: Array,
        button_name: String
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
