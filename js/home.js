'use strict';

let HOME_OBJ = {

    init: function init() {
        HOME_OBJ.load_products();
    },

    load_products: function load_products() {

        if ( $('#load_products').length ) { // console.log('Hey legth');
            var obj_data = {
                action: 'load_products',
                ajax_nonce: ut_home.ajax_nonce,
            };
        
            $.ajax({
                url: ut_home.ajax_url,
                data: obj_data,
                type: 'POST',
                success: function(response) {
        
                    if (response.success) {
                        $('#load_products').html(response.data.products);
                    }
                }
            });
        }
    },

};

$(document).ready(HOME_OBJ.init);