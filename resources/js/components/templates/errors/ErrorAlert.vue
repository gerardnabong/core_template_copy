<template>
    <b-alert
        show
        variant="danger"
        v-if="error"
        class="client-portal-alert"
    >
        <div v-html="error.message || error" />
        <div
            v-for="error_type in error.errors"
            :key="error_type"
        >
            <div
                v-for="error_message in error_type"
                :key="error_message"
                v-html="error_message"
            />
        </div>
    </b-alert>
</template>

<script>
'use strict';

export default {
    name: 'ErrorAlert',

    computed: {
        error () {
            return this.$store.getters.getError;
        }
    },
};
</script>
