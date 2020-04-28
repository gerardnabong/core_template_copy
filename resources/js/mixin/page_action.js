'use strict';

export default {
 methods: {
    saveActions(data) {
        let form_data = data;
        $.post({
            url: '/api/save-client-action',
            data: action,
            success: (response) => {

            },
            error: (response) => {

            },
            completed: () => {

            },
        });
    }
 },
}
