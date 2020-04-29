'use strict';

export default {
    data () {
        return {
            page_form_data: {
                id: null,
                page_id: null,
            },
        }
    },

    methods: {
        saveAction (data = null) {
            let form_data = Object.assign({}, this.page_form_data, data);
            let url = '/api/client-interaction/';
            let type = 'POST';
            if (form_data.id) {
                url+=form_data.id;
                type = 'PUT';
            }
            $.ajax({
                url: url,
                data: form_data,
                type: type,
                success: (response) => {
                    if (response.id) {
                        this.page_form_data.id = response.id;
                    }
                },
            });
        },
    },

    created () {
        this.page_form_data.page_id = this.page_id;
        // sample lead_id this should get from vuex client
        this.page_form_data.lead_id = 1001,
        this.saveAction();
    }
}
